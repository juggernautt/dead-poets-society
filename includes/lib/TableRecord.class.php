<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');

abstract class TableRecord
{
    /**
     * @var array
     */
    protected $props;
    protected $fields;

    protected $table;
    protected $primary_key;
    protected $primary_key_value;
    protected $al = null;

    public function __construct($props = array())
    {
        global $config;
        $this->al = new AL($config['database']);
        $this->setProps($props);
    }


    public function setProps($props)
    {
        $this->props = $this->pickElements($props, $this->fields);
    }

    public function getProps()
    {
        return $this->props;
    }


    /**
     * Return elements with $keys from $array
     * pickElements(['a'=>1,'b'=>2,'c'=>3], ['a','c','l']) => ['a'=>1, 'c'=>3]
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