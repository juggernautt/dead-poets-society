<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');
require_once('lib/AL.php');
require_once('lib/TableRecord.class.php');

class Post extends TableRecord
{
    protected $props = array();
    private $fields = array('p_id', 'u_id', 'p_text', 'p_date');
    private $table = 'posts';
    private $primary_key = 'p_id';
    //private $primary_key_value = null;

    private $al = null;

    public function setProps($props) {
        $this->props = $this->pickElements($props, $this->fields);
    }

    public function getProps() {
        return $this->props;
    }

    public function __construct($props)
    {
        global $config;
        $this->al = new AL($config['database']);
        //$this->primary_key_value = $props[$this->primary_key];
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
        $isValid = $this->getErrors();
        if($isValid) {
           return $this->al->insert_one($this->table, $this->props);
        }
        return false;
    }

}