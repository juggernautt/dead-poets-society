<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/Post.class.php');
require_once('lib/User.class.php');
require_once('lib/Relationship.class.php');
require_once('lib/DAL.php');
require_once('lib/AL.php');

/**
 * @param int $u_id
 * @return array|false
 */
function selectUser($u_id)
{
    $u = TableRecord::getRecord('users', $u_id);
    return $u->getProps(TRUE);
}


function createNewPost($props)
{
    $p = new Post($props);
    $p->save();
    return $p->getProps(TRUE);
}

/**
 * @param $u_id
 * @return false|int
 */
function deactivateProfile($u_id)
{
    $u = new User();
    return $u->deactivate($u_id);
}

/**
 * @param $u_id
 * @return false|int
 */
function activateProfile($u_id)
{
    $u = new User();
    return $u->activate($u_id);
}

/**
 * @param $u_id
 * @return bool
 */
function isDeactivated($u_id)
{
    $u = new User();
    $user = $u->selectById($u_id);
    return $user ? $user['u_is_frozen_account'] : false;
}


/**
 * @param array
 * @return array|false
 */
function addFriend($props)
{
    $r = new Relationship($props);
    $r->save();
    return $r->getProps(TRUE);
}

/**
 * @param array
 * @return array|false
 */
function acceptFriendship($props)
{
    $r = TableRecord::getRecord('relationship', $props['r_id']);
//    $r->setProps()
    $r = new Relationship($props);
    return $r->accept();
}

/**
 * @param $my_id
 * @param $other_id
 * @return array|bool|false
 */
function declineFriendship($my_id, $other_id)
{
    global $config;
    $al = new AL($config['database']);
    $props = array(
        'u_id1' => $my_id,
        'u_id2' => $other_id,
        'r_status' => 'DECLINED',
        'r_updated_at' => date('d/m/Y')
    );
    $preds = array(
        'u_id1' => $other_id,
        'u_id2' => $my_id,
        'r_status' => 'REQUEST_SENT'
    );
    return $al->update_many('relationship', $preds, $props);
}

/**
 * @param $my_id
 * @param $other_id
 * @return array|bool|false
 */
function unFriend($my_id, $other_id)
{
    global $config;
    $al = new AL($config['database']);
    $preds1 = array(
        'u_id1' => $my_id,
        'u_id2' => $other_id,
        'r_status' => 'FRIENDS'
    );
    $preds2 = array(
        'u_id1' => $other_id,
        'u_id2' => $my_id,
        'r_status' => 'FRIENDS'
    );
    $res1 = $al->delete_many('relationship', $preds1);
    $res2 = $al->delete_many('relationship', $preds2);
    return $res1 || $res2;
}

/**
 * @param $my_id
 * @param $other_id
 * @return array|bool|false
 */
function regretAndBecomeFriends($my_id, $other_id)
{
    global $config;
    $al = new AL($config['database']);

    $props = array(
        'u_id1' => $my_id,
        'u_id2' => $other_id,
        'r_status' => 'FRIENDS'
    );
    $preds = array(
        'u_id1' => $my_id,
        'u_id2' => $other_id,
        'r_status' => 'DECLINED'
    );
    return $al->update_many('relationship', $preds, $props);
}


/**
 * @param $u_id
 * @return array|bool|false
 */
function selectUserPosts($u_id)
{
    global $config;
    $al = new AL($config['database']);
    $sql = "SELECT * FROM `posts` WHERE u_id= ? ORDER BY p_date DESC";
    $posts = $al->query($sql, [$u_id]);
    if (!$posts) {
        return false;
    }
    return $posts;
}


function isRelationship($my_id, $other_id)
{
    global $config;
    $al = new AL($config['database']);
    $preds1 = array(
        'u_id1' => $my_id,
        'u_id2' => $other_id

    );
    $preds2 = array(
        'u_id1' => $other_id,
        'u_id2' => $my_id
    );
    $res = $al->select_many('relationship', $preds1);
    return $res ? $res : $al->select_many('relationship', $preds2);
}

/**
 * @param $my_id
 * @param $order_by
 * @return array|bool
 */
function selectAllActiveUsers($my_id, $order_by)
{
    global $config;
    $al = new AL($config['database']);
    $sql = "SELECT * FROM `users` WHERE u_id!=? AND u_is_frozen_account != 1 ORDER BY `u_nickname` $order_by";
    $users = $al->query($sql, [$my_id]);
    if (!$users) {
        return false;
    }
    return $users;
}


/**
 * @param $my_id
 * @param $order_by
 * @return array|bool
 */
function selectActiveUserFriends($my_id, $order_by)
{
    global $config;
    $al = new AL($config['database']);
    $sql = "SELECT * FROM `users` LEFT JOIN `relationship` ON (users.u_id=relationship.u_id1 OR users.u_id=relationship.u_id2)
            WHERE r_status='FRIENDS' AND u_is_frozen_account != 1 AND u_id!= ? AND (u_id1= ? OR u_id2 = ?) ORDER BY  `u_nickname` $order_by";
    $userFriends = $al->query($sql, [$my_id, $my_id, $my_id]);
    if (!$userFriends) {
        return false;
    }
    return $userFriends;
}


/**
 * @param $my_id
 * @return array|bool|false
 */
function selectRequests($my_id)
{
    global $config;
    $al = new AL($config['database']);
    $sql = "SELECT * FROM  `users` LEFT JOIN `relationship` ON users.u_id=relationship.u_id1 WHERE r_status='REQUEST_SENT' AND u_id2= ? AND u_is_frozen_account != 1";
    $requests = $al->query($sql, [$my_id]);
    if (!$requests) {
        return false;
    }
    return $requests;
}

/**
 * @param $my_id
 * @return array|bool|false
 */
function selectDeclines($my_id)
{
    global $config;
    $al = new AL($config['database']);
    $sql = "SELECT * FROM  `users` LEFT JOIN `relationship` ON users.u_id=relationship.u_id2 WHERE r_status='DECLINED' AND u_is_frozen_account != 1 AND u_id1= ? ";
    $declines = $al->query($sql, [$my_id]);
    if (!$declines) {
        return false;
    }
    return $declines;
}

/**
 * @param array
 * @return array|false
 */
function selectEmailAndPasswordLogInProcess($props)
{
    $u = new User();
    return $u->authorize($props);
}

function addNewUser($props)
{
    $u = new User($props);
    $u->save();
    return $u->getProps(TRUE);
}


function updateExistingUser($props)
{
    $u = TableRecord::getRecord('user', $props['u_id']);
    $u->setProps($props);
    $u->save();
    return $u->getProps(TRUE);
}

/**
 * @param $my_id
 * @param $other_id
 * @return string
 */
function getRelationshipStatus($my_id, $other_id)
{

    global $config;
    $al = new AL($config['database']);

    $res = isRelationship($my_id, $other_id);
    if (!$res) {
        return NO_RELATIONSHIP;
    }

    if ($al->select_many('relationship', ['r_status' => 'FRIENDS', 'u_id1' => $my_id, 'u_id2' => $other_id]) ||
        $al->select_many('relationship', ['r_status' => 'FRIENDS', 'u_id1' => $other_id, 'u_id2' => $my_id]))
    {
        return FRIENDS;
    }

    $res = $al->select_many('relationship', ['r_status' => 'REQUEST_SENT', 'u_id1' => $my_id, 'u_id2' => $other_id]);
    if($res) {
        return MINE_REQUEST;
    }

    $res = $al->select_many('relationship', ['r_status' => 'REQUEST_SENT', 'u_id1' => $other_id, 'u_id2' => $my_id]);
    if($res) {
        return HIS_REQUEST;
    }

    $res = $al->select_many('relationship', ['r_status' => 'DECLINED', 'u_id1' => $my_id, 'u_id2' => $other_id]);
    if($res) {
        return MINE_DECLINE;
    }

    $res = $al->select_many('relationship', ['r_status' => 'DECLINED', 'u_id1' => $other_id, 'u_id2' => $my_id]);
    if($res) {
        return HIS_DECLINE;
    }

    return null;
}

/**
 * @param $my_id
 * @param $other_id
 * @return array
 */
function getRelationship($my_id, $other_id)
{

}


