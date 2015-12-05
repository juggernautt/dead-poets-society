<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');
require_once('lib/AL.php');
require_once('lib/TableRecord.class.php');


class Relationship extends TableRecord
{
    const NO_RELATIONSHIP = "NO RELATIONSHIP";
    const FRIENDS = "FRIENDS";
    const MINE_REQUEST = "MINE REQUEST";
    const HIS_REQUEST = "HIS REQUEST";
    const MINE_DECLINE = "MINE DECLINE";
    const HIS_DECLINE = "HIS DECLINE";

    protected $props = array();
    private $fields = array('r_id', 'u_id1', 'u_id2', 'r_status', 'r_updated_at');
    private $table = 'relationship';
    private $primary_key = 'r_id';

    private $al = null;

    public function setProps($props)
    {
        $this->props = $this->pickElements($props, $this->fields);
    }

    public function getProps()
    {
        return $this->props;
    }

    public function __construct($props = array())
    {
        global $config;
        $this->al = new AL($config['database']);
        $this->setProps($props);
    }

    public function add()
    {
        return $this->al->insert_one($this->table, $this->props);
    }





}