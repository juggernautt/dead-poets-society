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
    $res = $p->save();
    if ($res) {
        return $p->getProps(TRUE);
    } else {
        return false;
    }
}

/**
 * @param $u_id
 * @return false|int
 */
function deactivateProfile($u_id)
{
    $u = TableRecord::getRecord('users', $u_id);
    return $u->deactivate();
}

/**
 * @param $u_id
 * @return false|int
 */
function activateProfile($u_id)
{
    $u = TableRecord::getRecord('users', $u_id);
    return $u->activate();
}

/**
 * @param $u_id
 * @return bool
 */
function isDeactivated($u_id)
{
    $u = TableRecord::getRecord('users', $u_id);
    return $u->isDeactivated();
}


/**
 * @param array
 * @return array|false
 */
function addFriend($props)
{
    $r = new Relationship($props); // $props = ['u_id1' => %num%, 'u_id2' => %num%, 'r_status' => %string%]
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
    $r->acceptOrRegret();
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
 * @param array
 * @return array|bool|false
 */
function unFriend($props)
{
    $r = TableRecord::getRecord('relationship', $props['r_id']);
    return $r->unFriend();
}

/**
 * @param array
 * @return array|bool|false
 */
function regretAndBecomeFriends($props)
{
    $r = TableRecord::getRecord('relationship', $props['r_id']);
    return $r->acceptOrRegret();
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
    $u = User::authorize($props['u_email'], $props['u_password']);
    return $u ? $u->getProps(TRUE) : false;
}

function addNewUser($props)
{
    $u = new User($props);
    $res = $u->save();
    if ($res) {
        return $u->getProps(TRUE);
    } else {
        return $res;
    }
}


function updateExistingUser($props)
{
    $u = TableRecord::getRecord('users', $props['u_id']);
    $u->setProps($props);
    $u->save();
    return $u->getProps(TRUE);
}



function getRelationship($my_id, $other_id)
{
   return Relationship::getRelationship($my_id, $other_id);
}

/**
 * @param $my_id
 * @param $other_id
 * @return string
 */
function getRelationshipStatus($my_id, $other_id)
{
    return Relationship::getStatus($my_id, $other_id);
}



