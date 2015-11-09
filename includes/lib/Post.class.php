<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');
require_once('lib/TableRecord.class.php');

class Post extends TableRecord
{
    private $props = array();
    private $fields = array('p_id', 'u_id', 'p_text', 'p_date');

    private $table = 'posts';
    private $primary_key = 'p_id';
    private $primary_key_value = null;

    public function setProps($props) {
        $this->props = $this->pickElements($props, $this->fields);
    }

    public function getProps() {
        return $this->props;
    }

    public function __construct($props)
    {
        $this->primary_key_value = $props[$this->primary_key];
        $this->setProps($props);

    }

    public function getErrors() {
        if($this->props['p_text'] == "") {
            return false;
        }
        return true;
    }

    public function createAndGet()
    {
        $errors = $this->getErrors();
        if($errors) {
            $sql = "INSERT INTO `posts` (u_id, p_text) VALUES (?, ?)";
            $insertedId = insert($sql, [$this->props['u_id'], $this->props['p_text']]);
            if (!$insertedId) {
                return false;
            }

            $sql = "SELECT * FROM `posts` WHERE p_id= ?";
            $post = get_record($sql, [$insertedId]);

            return $post;
        }
        return $errors;

    }
}