<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');
require_once('lib/AL.php');

abstract class TableRecord
{
    /**
     * @var array
     */
    protected $props;
    protected $fields;

    protected $table;
    protected $primary_key;
    protected $primary_key_value = null;
    protected $al = null;


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

    public function __construct($props = array())
    {
        global $config;
        $this->al = new AL($config['database']);
        $this->primary_key = $this->al->pk_field($this->table);

        if(isset($props[$this->primary_key])) {
            $this->primary_key_value = $props[$this->primary_key];
        }

        $this->setProps($props);
    }


    public function setProps($props)
    {
        $this->props = $this->pickElements($props, $this->fields);
    }

    public function setProp($propName, $propValue)
    {
        $this->props[$propName] = $propValue;
        return $propValue;
    }

    public function getProps($isIncludePk = false)
    {
        $result = $this->props;
        if ($isIncludePk) {
            $result[$this->primary_key] = $this->primary_key_value;
        }
        return $result;
    }

    public function getProp($propName, $defaultValue = null)
    {
        return isset($this->props[$propName]) ? $this->props[$propName] : $defaultValue;
    }

    public function getErrors() {
        return array();
    }

    /**
     * @return true | array with errors
     */
    public function save()
    {
        $errors = $this->getErrors();
        if (count($errors)) {
            return $errors;
        }

        if($this->primary_key_value === null) {
            $record = $this->al->insert_one($this->table, $this->props);
            if (!$record) {
                return false;
            }
            $this->primary_key_value = $record[$this->primary_key];
        } else {
            $record = $this->al->update_one($this->table, $this->primary_key_value, $this->props);
            if (!$record) {
                return false;
            }
        }
        return true;
    }

    public function delete()
    {
        return $this->al->delete_one($this->table, $this->primary_key_value);
    }

    /**
     * @param string $table
     * @param number $id
     * @return Post|Relationship|User
     */
    public static function getRecord($table, $id) {
        global $config;
        $al = new AL($config['database']);
        $record = $al->select_one($table, $id);
        switch ($table) {
            case 'users':
                return new User($record);
                break;
            case 'posts':
                return new Post($record);
                break;
            case 'relationship':
                return new Relationship($record);
                break;
        }
        return false;
    }




}