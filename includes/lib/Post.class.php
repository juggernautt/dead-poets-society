<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');
require_once('lib/AL.php');
require_once('lib/TableRecord.class.php');

class Post extends TableRecord
{
    protected $props = array();
    protected $fields = array('p_id', 'u_id', 'p_text', 'p_date');
    protected $table = 'posts';
    protected $primary_key = 'p_id';
    //private $primary_key_value = null;



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