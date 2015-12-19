<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');
require_once('lib/AL.php');
require_once('lib/TableRecord.class.php');

class Post extends TableRecord
{
    protected $props = array();
    protected $fields = array('u_id', 'p_text', 'p_date');
    protected $table = 'posts';




    public function getErrors() {
        $errors = array();
        if($this->props['p_text'] == "") {
            $errors['p_text'] = "Text cannot be empty";
        }
        return $errors;
    }

    public static function selectAll($id) {
        global $config;
        $al = new AL($config['database']);
        $sql = "SELECT * FROM `posts` WHERE u_id= ? ORDER BY p_date DESC";
        $posts = $al->query($sql, [$id]);
        if (!$posts) {
            return array();
        }
        return $posts;
    }

}