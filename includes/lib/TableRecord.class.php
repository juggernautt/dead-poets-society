<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');

class TableRecord
{
    protected function pickElements($array, $keys)
    {
        $result = array();
        foreach ($keys as $key) {
            $result[$key] = isset($array[$key]) ? $array[$key] : "";
        }
        return $result;
    }

    /**
     * Insert properties from $this->props into database and return newly created record or array with errors
     */
    public function insertAndGet()
    {
        // INSERT INTO $this->table (u_id, p_text, p_date) VALUES (?, ?, ?)
    }

    /**
     * Update properties from $this->props into database and return newly created record or array with errors
     */
    public function updateAndGet()
    {
        // UPDATE `posts` SET u_id=?, p_text=?, p_date=? WHERE p_id=3
    }
}