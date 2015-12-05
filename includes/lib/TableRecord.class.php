<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');

class TableRecord
{
    /**
     *
     * @var array
     */
    protected $props;


    /**
     * Return elements with $keys from $array
     * pickElements(['a'=>1,'b'=>2,'c'=>3], ['a','c','l']) => ['a'=>1, 'c'=>3]
     *
     * @param $array
     * @param $keys
     * @return array
     */
    protected function pickElements($array, $keys)
    {
        $result = array();
        foreach ($keys as $key) {
            if (isset($array[$key])) {
                $result[$key] = $array[$key];
            }
        }
        return $result;
    }
//
//    /**
//     * Insert properties from $this->props into database and return newly created record or array with errors
//     */
//    public function insertAndGet()
//    {
//        // INSERT INTO $this->table (u_id, p_text, p_date) VALUES (?, ?, ?)
//    }
//
//    /**
//     * Update properties from $this->props into database and return newly created record or array with errors
//     */
//    public function updateAndGet()
//    {
//        // UPDATE `posts` SET u_id=?, p_text=?, p_date=? WHERE p_id=3
//    }
}