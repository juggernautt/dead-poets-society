<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');

class Post
{
    private $props = array();
    private $fields = array('p_id', 'u_id', 'p_text', 'p_date');


    private function pickElements($array, $keys)
    {
        $result = array();
        foreach ($keys as $key) {
            $result[$key] = isset($array[$key]) ? $array[$key] : "";
        }
        return $result;
    }

    public function setProps($props) {
        $this->props = $this->pickElements($props, $this->fields);
    }

    public function getProps() {
        return $this->props;
    }

    public function __construct($props)
    {
        $this->setProps($props);

    }


    public function createAndGet()
    {
        $sql = "INSERT INTO `posts` (u_id, p_text) VALUES (?, ?)";
        $insertedId = insert($sql, [$this->props['u_id'], $this->props['p_text']]);
        if (!$insertedId) {
            return false;
        }

        $sql = "SELECT * FROM `posts` WHERE p_id= ?";
        $post = get_record($sql, [$insertedId]);

        return $post;
    }
}