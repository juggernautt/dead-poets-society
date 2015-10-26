<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');

class Post
{
    private $p_id;
    private $u_id;
    private $p_text;
    private $p_date;

    public function __construct($u_id, $p_text)
    {
        $this->setUId($u_id);
        $this->setPText($p_text);
    }

    /**
     * @return mixed
     */
    public function getPText()
    {
        return $this->p_text;
    }

    /**
     * @param mixed $p_text
     * @return bool
     */
    public function setPText($p_text)
    {
        if ($p_text == "") {
            return false;
        }
        $this->p_text = $p_text;
        return true;
    }

    /**
     * @return mixed
     */
    public function getUId()
    {
        return $this->u_id;
    }

    /**
     * @param mixed $u_id
     */
    public function setUId($u_id)
    {
        $this->u_id = $u_id;
    }

    /**
     * @return mixed
     */
    public function getPId()
    {
        return $this->p_id;
    }

    /**
     * @param mixed $p_id
     */
    public function setPId($p_id)
    {
        $this->p_id = $p_id;
    }

    /**
     * @return mixed
     */
    public function getPDate()
    {
        return $this->p_date;
    }

    /**
     * @param mixed $p_date
     */
    public function setPDate($p_date)
    {
        $this->p_date = $p_date;
    }

    /**
     * @return array | false - ID of inserted new post
     */
    public function saveToDbAndGet()
    {
        $sql = "INSERT INTO `posts` (u_id, p_text) VALUES (?, ?)";
        $insertedId = insert($sql, [$this->u_id, $this->p_text]);
        if (!$insertedId) {
            return false;
        }

        $sql = "SELECT * FROM `posts` WHERE p_id= ?";
        $post = get_record($sql, [$insertedId]);

        return $post;
    }
}