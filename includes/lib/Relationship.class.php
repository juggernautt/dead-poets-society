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
    protected $fields = array('u_id1', 'u_id2', 'r_status', 'r_updated_at');
    protected $table = 'relationship';




//    public function add()
//    {
//        return $this->al->insert_one($this->table, $this->props);
//    }


    public function accept()
    {
        $newProps = [
            'u_id1' => $this->props['u_id2'],
            'u_id2' => $this->props['u_id1'],
            'r_status' => 'FRIENDS'
        ];
        $this->setProps($newProps);
        return $this->save();
//        $this->al->update_many('relationships', $this->props, $newProps);
    }




}