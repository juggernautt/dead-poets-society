<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/businessLogic.php');


session_start();

$action = $_REQUEST['action'];

if ($action == "post")
{
    $props = array();
    $props['p_text'] = isset($_POST['p_text']) ? $_POST['p_text'] : "";
    $props['u_id'] = $_SESSION['loggedInUser']['u_id'];
    $post = createNewPost($props);
    print json_encode($post);
    return;
}

if ($action == "Deactivate profile")
{
    $result = deactivateProfile($_SESSION['loggedInUser']['u_id']);
    print json_encode($result);
    return;

}

if ($action == "Activate profile")
{
    $result = activateProfile($_SESSION['loggedInUser']['u_id']);
    print json_encode($result);
    return;
}

if ($action == "Accept")
{
    $props = array('u_id' => $_POST['u_id'], 'r_id' => $_POST['r_id']);
    $acceptedUser = acceptFriendship($props);
    $result = array(
        'u_about_myself' => $acceptedUser['u_about_myself'],
        'u_id' => $acceptedUser['u_id'],
        'days' => calculateDaysTillTheDate($acceptedUser['u_birthdate'])
    );
    print json_encode($result);
    return;
}

if ($action == "Add Friend")
{
    $props = array('u_id1' => $_SESSION['loggedInUser']['u_id'], 'u_id2' => $_POST['u_id'], 'r_status' => 'REQUEST_SENT', 'r_updated_at' => date('Y-m-d H:i:s'));
    $addedFriend = addFriend($props);
    print json_encode($addedFriend);
    return;
}

if ($action == "Decline")
{
    $props = array('u_id' => $_POST['u_id'], 'r_id' => $_POST['r_id'], 'r_updated_at' => date('Y-m-d H:i:s'));
    declineFriendship($props);
    print json_encode($_POST['u_id']);
    return;
}


if ($action == "Unfriend")
{
    $props = array('u_id' => $_POST['u_id'], 'r_id' => $_POST['r_id']);
    unFriend($props);
    print json_encode($_POST['u_id']);
    return;

}

if ($action == "Regret button")
{
    $props = array('u_id' => $_POST['u_id'], 'r_id' => $_POST['r_id']);
    regretAndBecomeFriends($props);
    print json_encode($_POST['u_id']);
    return;
}

if ($action == "Form Filling")
{
    $props = $_POST;
    $props['u_id'] = isset($_SESSION['loggedInUser']['u_id']) ? ($_SESSION['loggedInUser']['u_id']) : null;
    $props['u_password'] = md5($props['u_password']);

    if ($_FILES) {
        $props['u_picture'] = move_files($_FILES['file1']);
        $props['u_secret_pic'] = move_files($_FILES['file2']);
    }
    if (!$props['u_id']) {
        $resultArr = addNewUser($props);
    } else {
        $resultArr = updateExistingUser($props);
    }

    if (isset($resultArr['u_id'])) {
        $_SESSION['loggedInUser'] = $resultArr;
    }
    print json_encode($resultArr);
    return;

}



/*if($action == "Select All Active Users") {
    if($_GET['order_by'] == "ASC") {
        $users = selectAllActiveUsersASC($_SESSION['loggedInUser']['u_id']);
        print json_encode($users);
        return;
    } else {
        $users = selectAllActiveUsersDESC($_SESSION['loggedInUser']['u_id']);
        print json_encode($users);
        return;
    }

}

if($action == "Select All Active Friends") {
    if($_GET['order_by'] == "ASC") {
        $friends = selectActiveUserFriendsASC($_SESSION['loggedInUser']['u_id']);
        print json_encode($friends);
        return;
    } else {
        $friends = selectActiveUserFriendsDESC($_SESSION['loggedInUser']['u_id']);
        print json_encode($friends);
        return;
    }
}*/



