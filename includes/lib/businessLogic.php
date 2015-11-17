<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/Post.class.php');
require_once('lib/User.class.php');
require_once('lib/DAL.php');
require_once('lib/AL.php');

/**
 * @param int $u_id
 * @return array|false
 */
function selectUser($u_id)
{
    global $config;
    $al = new AL($config['database']);
    return $al->select_one('users', $u_id);
}


function createNewPost($props)
{
    global $config;
    $al = new AL($config['database']);
    return $al->insert_one('posts', $props);
}

/**
 * @param $u_id
 * @return false|int
 */
function deactivateProfile($u_id)
{
    global $config;
    $al = new AL($config['database']);
    return $al->update_one('users', $u_id, array('u_is_frozen_account' => 1));
}

/**
 * @param $u_id
 * @return false|int
 */
function activateProfile($u_id)
{
    global $config;
    $al = new Al($config['database']);
    return $al->update_one('users', $u_id, array('u_is_frozen_account' => 0));
}

/**
 * @param $u_id
 * @return bool
 */
function isDeactivated($u_id)
{
    global $config;
    $al = new Al($config['database']);
    $user = $al->select_one('users', $u_id);
    return $user ? $user['u_is_frozen_account'] : false;
}


/**
 * @param $my_id
 * @param $other_id
 * @return array|false
 */
function addFriend($my_id, $other_id)
{
    global $config;
    $al = new AL($config['database']);
    $props = array(
        'u_id1' => $my_id,
        'u_id2' => $other_id,
        'r_status' => 'REQUEST_SENT',
        'r_updated_at' => time()
    );
    return $al->insert_one('relationship', $props);
}

/**
 * @param $my_id
 * @param $other_id
 * @return array|false
 */
function acceptFriendship($my_id, $other_id)
{
    global $config;
    $al = new AL($config['database']);
    $props = array(
        'u_id1' => $my_id,
        'u_id2' => $other_id,
        'r_status' => 'FRIENDS'
    );
    $preds = array(
        'u_id1' => $other_id,
        'u_id2' => $my_id,
        'r_status' => 'REQUEST_SENT'
    );
    return $al->update_many('relationships', $preds, $props);
//
//
//    $sql = "UPDATE `relationship` SET u_id1 = ?, u_id2 = ? , r_status = 'FRIENDS' WHERE u_id2 = ? AND u_id1 = ? AND r_status='REQUEST_SENT' ";
//    $changeRelationship = update($sql, [$my_id, $other_id, $my_id, $other_id]);
//    if ($changeRelationship === false) {
//        return false;
//    }
//    $acceptedUser = selectUser($other_id);
//    return $acceptedUser;
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
        'r_updated_at' => time()
    );
    $preds = array(
        'u_id1' => $other_id,
        'u_id2' => $my_id,
        'r_status' => 'REQUEST_SENT'
    );
    return $al->update_many('relationship', $preds, $props);

//
//    $sql = "UPDATE `relationship` SET r_updated_at = NOW(), u_id1 = ?, u_id2 = ?, r_status = 'DECLINED' WHERE u_id2 = ? AND u_id1 = ? AND r_status='REQUEST_SENT' ";
//    $changeRelationship = update($sql, [$my_id, $other_id, $my_id, $other_id]);
//    if ($changeRelationship === false) {
//        return false;
//    }
//    $declinedUser = selectUser($other_id);
//    return $declinedUser;
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
    $res = $al->delete_many('relatioship', $preds1);
    return $res ? $res : $al->delete_many('relationship', $preds2);
//
//    $sql = "DELETE FROM `relationship` WHERE r_status='FRIENDS' AND ((u_id1 = ? AND u_id2 = ?) OR (u_id2 = ? AND u_id1 = ?)) ";
//    $changeRelationship = delete($sql, [$my_id, $other_id, $my_id, $other_id]);
//    if ($changeRelationship === false) {
//        return false;
//    }
//    $unFriendUser = selectUser($other_id);
//    return $unFriendUser;
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
//    $sql = "UPDATE `relationship` SET  r_status = 'FRIENDS' WHERE u_id1 = ? AND u_id2 = ? AND r_status='DECLINED' ";
//    $changeRelationship = update($sql, [$my_id, $other_id]);
//    if ($changeRelationship === false) {
//        return false;
//    }
//    $regret = selectUser($other_id);
//    return $regret;
}


/**
 * @param $u_id
 * @return array|bool|false
 */
function selectUserPosts($u_id)
{
    $sql = "SELECT * FROM `posts` WHERE u_id= ? ORDER BY p_date DESC"; // $al->select_many('posts', [u_id=>$_id])
    $posts = get_records($sql, [$u_id]);
    if ($posts === false) {
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

//    $sql = "SELECT * FROM `relationship` WHERE (u_id1 = ? AND u_id2 = ?) OR (u_id1 = ? AND u_id2 = ?)";
//    $relationship = get_record($sql, [$my_id, $other_id, $other_id, $my_id]);
//    if ($relationship === false) {
//        return false;
//    }
//    return $relationship;
}

/**
 * @param $my_id
 * @param $order_by
 * @return array|bool
 */
function selectAllActiveUsers($my_id, $order_by)
{
    $sql = "SELECT * FROM `users` WHERE u_id!=? AND u_is_frozen_account != 1 ORDER BY `u_nickname` $order_by";
    $users = get_records($sql, [$my_id]);
    if ($users === false) {
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
    $sql = "SELECT * FROM `users` LEFT JOIN `relationship` ON (users.u_id=relationship.u_id1 OR users.u_id=relationship.u_id2)
            WHERE r_status='FRIENDS' AND u_is_frozen_account != 1 AND u_id!= ? AND (u_id1= ? OR u_id2 = ?) ORDER BY  `u_nickname` $order_by";
    $userFriends = get_records($sql, [$my_id, $my_id, $my_id]);
    if ($userFriends === false) {
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
    $sql = "SELECT * FROM  `users` LEFT JOIN `relationship` ON users.u_id=relationship.u_id1 WHERE r_status='REQUEST_SENT' AND u_id2= ? AND u_is_frozen_account != 1";
    $requests = get_records($sql, [$my_id]);
    if ($requests === false) {
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
    $sql = "SELECT * FROM  `users` LEFT JOIN `relationship` ON users.u_id=relationship.u_id2 WHERE r_status='DECLINED' AND u_is_frozen_account != 1 AND u_id1= ? ";
    $declines = get_records($sql, [$my_id]);
    if ($declines === false) {
        return false;
    }
    return $declines;
}

/**
 * @param $u_email
 * @param  $u_password
 * @return array|false
 */
function selectEmailAndPasswordLogInProcess($u_email, $u_password)
{
    global $config;
    $al = new AL($config['database']);
    $preds = array(
        'u_email' => $u_email,
        'u_password' => md5($u_password)
    );
    return $al->select_many('users', $preds);
//    $sql = "SELECT * FROM `users` WHERE u_email=? AND u_password=? ";
//    $loggedInUser = get_record($sql, [$u_email, md5($u_password)]);
//    if ($loggedInUser === false) {
//        return false;
//    }
//    return $loggedInUser;
}






function addNewUser($props)
{
//    $u = new User($props);
//    return $u->createAndGet();
    global $config;
    $al = new AL($config['database']);
    return $al->insert_one('users', $props);
}


function updateExistingUser($props)
{
    $u2 = new User($props);
    return $u2->updateAndGet();
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



