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
    $u = TableRecord::getRecord('users', $u_id);
    return $u->deactivate($u_id);
}

/**
 * @param $u_id
 * @return false|int
 */
function activateProfile($u_id)
{
    $u = TableRecord::getRecord('users', $u_id);
    return $u->activate($u_id);
}

/**
 * @param $u_id
 * @return bool
 */
function isDeactivated($u_id)
{
    $u = TableRecord::getRecord('users', $u_id);
    $isFrozen = $u->getProp('u_is_frozen_account');
    return $isFrozen;
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
    $r->accept();
    $u = TableRecord::getRecord('users', $props['u_id']);
    return $u->getProps(TRUE);
}

/**
 * @param array
 * @return array|bool|false
 */
function declineFriendship($props)
{

    $r = TableRecord::getRecord('relationship', $props['r_id']);
    return $r->decline();
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
    return Post::selectAll($u_id);
}




/**
 * @param array
 * @return array|bool
 */
function selectAllActiveUsers($props)
{
   return User::selectAllActive($props);
}


/**
 * @param array
 * @return array|bool
 */
function selectActiveUserFriends($props)
{
    return User::selectActiveFriends($props);
}


/**
 * @param $id
 * @return array|bool|false
 */
function selectRequests($id)
{
    return Relationship::allRequests($id);
}

/**
 * @param $id
 * @return array|bool|false
 */
function selectDeclines($id)
{
    return Relationship::allDeclines($id);
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



function getRelationship($my_id, $other_id)
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
 * @param $other_id
 * @return string
 */
function getRelationshipStatus($my_id, $other_id)
{

    global $config;
    $al = new AL($config['database']);

    $res = getRelationship($my_id, $other_id);
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



