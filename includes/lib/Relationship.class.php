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


    public function acceptOrRegret()
    {

        $this->setProp('r_status', 'FRIENDS');
        return $this->save();
    }

    public function decline()
    {
        $this->setProp('r_status', 'DECLINED');
        return $this->save();
    }

    public function unFriend()
    {
        return $this->delete();
    }

    /**
     * @param $my_id
     * @param $other_id
     * @return array|bool
     */
    public static function getRelationship($my_id, $other_id)
    {
        global $config;
        $al = new AL($config['database']);

        $predicates1 = array(
            'u_id1' => $my_id,
            'u_id2' => $other_id

        );
        $predicates2 = array(
            'u_id1' => $other_id,
            'u_id2' => $my_id
        );
        $res = $al->select_many('relationship', $predicates1);
        return $res ? $res : $al->select_many('relationship', $predicates2);
    }


    public static function getStatus($my_id, $other_id)
    {

        $result = Relationship::getRelationship($my_id, $other_id);
        if(!$result) {
            return Relationship::NO_RELATIONSHIP;
        }
        if($result['r_status'] == 'FRIENDS') {
            return Relationship::FRIENDS;
        }
        if($result['r_status'] == 'REQUEST_SENT' && $result['u_id1'] == $my_id) {
            return Relationship::MINE_REQUEST;
        }
        if($result['r_status'] == 'REQUEST_SENT' && $result['u_id2'] == $my_id) {
            return Relationship::HIS_REQUEST;
        }
        if($result['r_status'] == 'DECLINED' && $result['u_id1'] == $my_id) {
            return Relationship::MINE_DECLINE;
        }
        if($result['r_status'] == 'DECLINED' && $result['u_id2'] == $my_id) {
            return Relationship::HIS_DECLINE;
        }
        return null;
    }


    public static function allRequests($id)
    {
        global $config;
        $al = new AL($config['database']);
        $sql = "SELECT * FROM  `users` LEFT JOIN `relationship` ON users.u_id=relationship.u_id1 WHERE r_status='REQUEST_SENT' AND u_id2= ? AND u_is_frozen_account != 1";
        $requests = $al->query($sql, [$id]);
        if (!$requests) {
            return array();
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
            return array();
        }
        return $declines;
    }

    public function getErrors()
    {
        $errors = array();
        if (!$this->primary_key_value) {
            $res = Relationship::getRelationship($this->props['u_id1'], $this->props['u_id2']);
            if($res) {
                $errors['u_id1'] = "Pair already exists";
            }
        }
        return $errors;

    }


}