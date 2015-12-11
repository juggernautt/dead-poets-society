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


    public function accept()
    {

        $this->setProp('r_status', 'FRIENDS');
        return $this->save();
    }

    public function decline()
    {
        $this->setProp('r_status', 'DECLINED');
        return $this->save();
    }

    public function unFriend($id)
    {
        return $this->al->delete_one($this->table, $id);
    }

    public function regret()
    {
        $this->setProp('r_status', 'FRIENDS');
        return $this->save();
    }


    public static function allRequests($id)
    {
        global $config;
        $al = new AL($config['database']);
        $sql = "SELECT * FROM  `users` LEFT JOIN `relationship` ON users.u_id=relationship.u_id1 WHERE r_status='REQUEST_SENT' AND u_id2= ? AND u_is_frozen_account != 1";
        $requests = $al->query($sql, [$id]);
        if (!$requests) {
            return false;
        }
        return $requests;
    }

    public static function allDeclines($id)
    {
        global $config;
        $al = new AL($config['database']);
        $sql = "SELECT * FROM  `users` LEFT JOIN `relationship` ON users.u_id=relationship.u_id2 WHERE r_status='DECLINED' AND u_is_frozen_account != 1 AND u_id1= ? ";
        $declines = $al->query($sql, [$id]);
        if (!$declines) {
            return false;
        }
        return $declines;
    }



}