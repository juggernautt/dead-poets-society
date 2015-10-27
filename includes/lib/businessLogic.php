<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/Post.class.php');
require_once('lib/User.class.php');
require_once('lib/DAL.php');

/**
 * @param int $u_id
 * @return array|false
 */
function selectUser($u_id)
{
    $sql = "SELECT * FROM `users` WHERE u_id=? ";
    $user = get_record($sql, [$u_id]);
    if ($user === false) {
        return false;
    }
    return $user;
}

/**
 * @param int $u_id
 * @param string $p_text
 * @return array|false
 */
function createNewPost($u_id, $p_text)
{
    $p = new Post($u_id, $p_text);
    return $p->createAndGet();
}

/**
 * @param $u_id
 * @return false|int
 */
function deactivateProfile($u_id)
{
    $sql = "UPDATE `users` SET u_is_frozen_account = 1 WHERE u_id = ?";
    $updatedRow = update($sql, [$u_id]);
    if ($updatedRow === false) {
        return false;
    }
    return $updatedRow;
}

/**
 * @param $u_id
 * @return false|int
 */
function activateProfile($u_id)
{
    $sql = "UPDATE `users` SET u_is_frozen_account = 0 WHERE u_id = ?";
    $updatedRow = update($sql, [$u_id]);
    if ($updatedRow === false) {
        return false;
    }
    return $updatedRow;
}

/**
 * @param $u_id
 * @return bool
 */
function isDeactivated($u_id)
{
    $sql = "SELECT u_is_frozen_account FROM `users` WHERE `u_id`=?";
    $isFrozen = get_record($sql, [$u_id]);
    if ($isFrozen === false) {
        return false;
    }
    return $isFrozen['u_is_frozen_account'];
}


/**
 * @param $my_id
 * @param $other_id
 * @return array|false
 */
function addFriend($my_id, $other_id)
{
    $sql = "INSERT INTO `relationship` (u_id1, u_id2, r_status, r_updated_at) VALUES (?, ? ,'REQUEST_SENT', NOW())";
    $changeRelationship = insert($sql, [$my_id, $other_id]);
    if (!$changeRelationship) {
        return false;
    }
    $recentlyAddedUser = selectUser($other_id);
    return $recentlyAddedUser;
}

/**
 * @param $my_id
 * @param $other_id
 * @return array|bool|false
 */
function acceptFriendship($my_id, $other_id)
{
    $sql = "UPDATE `relationship` SET u_id1 = ?, u_id2 = ? , r_status = 'FRIENDS' WHERE u_id2 = ? AND u_id1 = ? AND r_status='REQUEST_SENT' ";
    $changeRelationship = update($sql, [$my_id, $other_id, $my_id, $other_id]);
    if ($changeRelationship === false) {
        return false;
    }
    $acceptedUser = selectUser($other_id);
    return $acceptedUser;
}

/**
 * @param $my_id
 * @param $other_id
 * @return array|bool|false
 */
function declineFriendship($my_id, $other_id)
{
    $sql = "UPDATE `relationship` SET r_updated_at = NOW(), u_id1 = ?, u_id2 = ?, r_status = 'DECLINED' WHERE u_id2 = ? AND u_id1 = ? AND r_status='REQUEST_SENT' ";
    $changeRelationship = update($sql, [$my_id, $other_id, $my_id, $other_id]);
    if ($changeRelationship === false) {
        return false;
    }
    $declinedUser = selectUser($other_id);
    return $declinedUser;
}

/**
 * @param $my_id
 * @param $other_id
 * @return array|bool|false
 */
function unFriend($my_id, $other_id)
{
    $sql = "DELETE FROM `relationship` WHERE r_status='FRIENDS' AND ((u_id1 = ? AND u_id2 = ?) OR (u_id2 = ? AND u_id1 = ?)) ";
    $changeRelationship = delete($sql, [$my_id, $other_id, $my_id, $other_id]);
    if ($changeRelationship === false) {
        return false;
    }
    $unFriendUser = selectUser($other_id);
    return $unFriendUser;
}

/**
 * @param $my_id
 * @param $other_id
 * @return array|bool|false
 */
function regretAndBecomeFriends($my_id, $other_id)
{
    $sql = "UPDATE `relationship` SET  r_status = 'FRIENDS' WHERE u_id1 = ? AND u_id2 = ? AND r_status='DECLINED' ";
    $changeRelationship = update($sql, [$my_id, $other_id]);
    if ($changeRelationship === false) {
        return false;
    }
    $regret = selectUser($other_id);
    return $regret;
}


/**
 * @param $u_id
 * @return array|bool|false
 */
function selectUserPosts($u_id)
{
    $sql = "SELECT * FROM `posts` WHERE u_id= ? ORDER BY p_date DESC";
    $posts = get_records($sql, [$u_id]);
    if ($posts === false) {
        return false;
    }
    return $posts;
}


function isRelationship($my_id, $other_id)
{
    $sql = "SELECT * FROM `relationship` WHERE (u_id1 = ? AND u_id2 = ?) OR (u_id1 = ? AND u_id2 = ?)";
    $relationship = get_record($sql, [$my_id, $other_id, $other_id, $my_id]);
    if ($relationship === false) {
        return false;
    }
    return $relationship;
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
    $sql = "SELECT * FROM `users` WHERE u_email=? AND u_password=? ";
    $loggedInUser = get_record($sql, [$u_email, md5($u_password)]);
    if ($loggedInUser === false) {
        return false;
    }
    return $loggedInUser;
}

/**
 * @param string $u_email
 * @return array|false
 */
function selectEmail($u_email)
{
    $sql = "SELECT * FROM `users` WHERE u_email=?";
    $email = get_record($sql, [$u_email]);
    if ($email === false) {
        return false;
    }
    return $email;
}


/**
 * @param $u_email
 * @param $u_password
 * @param $u_nickname
 * @param $u_birthdate
 * @param $isToCheckMail
 * @return array
 */
//function formValidation($u_email, $u_password, $u_nickname, $u_birthdate, $isToCheckMail)
//{
//    $errors = array();
//    if ($u_email == "" || $u_password == "" || $u_nickname == "" || $u_birthdate == "") {
//        $errors['non_empty'] = "Email, password, username and birthday should not be empty";
//    }
//    if (!preg_match("/([A-Za-z0-9]+)/", $u_password)) {
//        $errors['u_password'] = "Only letters and numbers allowed";
//    }
//    if ($isToCheckMail) {
//        $result = selectEmail($u_email);
//        if ($result) {
//            $errors['u_email'] = "Your email should be unique";
//        }
//    }
//    return $errors;
//
//}

/**
 * @param $u_email
 * @param $u_password
 * @param $u_nickname
 * @param $u_birthdate
 * @param $u_about_myself
 * @param $u_picture
 * @param $u_secret_pic
 * @return array|false
 */
function addNewUser($u_email, $u_password, $u_nickname, $u_birthdate, $u_about_myself, $u_picture, $u_secret_pic)
{
//    $errors = formValidation($u_email, $u_password, $u_nickname, $u_birthdate, TRUE);
//    if (count($errors) == 0) {
//        $sql = "INSERT INTO `users` (u_email, u_password, u_nickname, u_birthdate, u_about_myself, u_picture, u_secret_pic) VALUES (?, ?, ?, ?, ?, ?, ?)";
//        $insert = insert($sql, [$u_email, $u_password, $u_nickname, $u_birthdate, $u_about_myself, $u_picture, $u_secret_pic]);
//        if (!$insert) {
//            return false;
//        }
//        $newUser = selectEmailAndPasswordLogInProcess($u_email, $u_password);
//        return $newUser;
//    }
//    return $errors;
    $u = new User($u_email, $u_password, $u_nickname, $u_birthdate, $u_about_myself, $u_picture, $u_secret_pic);
    return $u->createAndGet();


}

/**
 * @param $u_email
 * @param $u_password
 * @param $u_nickname
 * @param $u_birthdate
 * @param $u_about_myself
 * @param $u_picture
 * @param $u_secret_pic
 * @param $u_id
 * @return array|false
 */
function updateExistingUser($u_email, $u_password, $u_nickname, $u_birthdate, $u_about_myself, $u_picture, $u_secret_pic, $u_id)
{
    $errors = formValidation($u_email, $u_password, $u_nickname, $u_birthdate, FALSE);
    if (count($errors) == 0) {
        $values = [$u_email, $u_password, $u_nickname, $u_birthdate, $u_about_myself];
        $sql = "UPDATE `users` SET u_email=?, u_password=?, u_nickname=?, u_birthdate=?, u_about_myself=?";
        //check if the user updates his pictures
        if ($u_picture) {
            array_push($values, $u_picture);
            $sql .= ", u_picture=?";
        }
        if ($u_secret_pic) {
            array_push($values, $u_secret_pic);
            $sql .= ", u_secret_pic=?";
        }
        array_push($values, $u_id);
        $sql .= " WHERE u_id=?";

        $update = update($sql, $values);
        if ($update === false) {
            return false;
        }
        $existingUser = selectUser($u_id);
        return $existingUser;
    }

    return $errors;
}

/**
 * @param $my_id
 * @param $other_id
 * @return string
 */
function getRelationshipStatus($my_id, $other_id)
{

    $sql = "SELECT * FROM `relationship` WHERE (u_id1 = ? AND u_id2 = ?) OR (u_id1 = ? AND u_id2 = ?)";
    $relationship = get_record($sql, [$my_id, $other_id, $other_id, $my_id]);
    if (!$relationship) {
        return NO_RELATIONSHIP;
    }

    $sql = "SELECT * FROM `relationship` WHERE r_status='FRIENDS' AND ((u_id1 = ? AND u_id2 = ?) OR (u_id1 = ? AND u_id2 = ?))";
    $friends = get_record($sql, [$my_id, $other_id, $other_id, $my_id]);
    if ($friends) {
        return FRIENDS;
    }

    $sql = "SELECT * FROM `relationship` WHERE r_status='REQUEST_SENT' AND (u_id1 = ? AND u_id2 = ?)";
    $mineRequest = get_record($sql, [$my_id, $other_id]);
    if ($mineRequest) {
        return MINE_REQUEST;
    }

    $sql = "SELECT * FROM `relationship` WHERE r_status='REQUEST_SENT' AND (u_id1 = ? AND u_id2 = ?)";
    $hisRequest = get_record($sql, [$other_id, $my_id]);
    if ($hisRequest) {
        return HIS_REQUEST;
    }

    $sql = "SELECT * FROM `relationship` WHERE r_status='DECLINED' AND (u_id1 = ? AND u_id2 = ?)";
    $mineDecline = get_record($sql, [$my_id, $other_id]);
    if ($mineDecline) {
        return MINE_DECLINE;
    }

    $sql = "SELECT * FROM `relationship` WHERE r_status='DECLINED' AND (u_id1 = ? AND u_id2 = ?)";
    $hisDecline = get_record($sql, [$other_id, $my_id]);
    if ($hisDecline) {
        return HIS_DECLINE;
    }

    return null;
}



