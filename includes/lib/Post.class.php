<?php

class Post
{
    private $p_id;
    private $u_id;
    private $p_text;
    private $p_date;

    /**
     * @return mixed
     */
    public function getPText()
    {
        return $this->p_text;
    }

    /**
     * @param mixed $p_text
     */
    public function setPText($p_text)
    {
        $this->p_text = $p_text;
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
}