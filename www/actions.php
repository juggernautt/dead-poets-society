<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/businessLogic.php');


session_start();

$action = $_REQUEST['action'];

if ($action == "post")
{
    $text = isset($_POST['p_text']) ? $_POST['p_text'] : "";
    $post = createNewPost($_SESSION['loggedInUser']['u_id'], $text);
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
    $acceptedUser = acceptFriendship($_SESSION['loggedInUser']['u_id'], $_POST['u_id']);
    $result = array(
        'u_about_myself' => $acceptedUser['u_about_myself'],
        'u_secret_pic' => $acceptedUser['u_secret_pic'],
        'u_id' => $_POST['u_id'],
        'days' => calculateDaysTillTheDate($acceptedUser['u_birthdate'])
    );
    print json_encode($result);
    return;
}

if ($action == "Add Friend")
{
    $addedFriend = addFriend($_SESSION['loggedInUser']['u_id'], $_POST['u_id']);
    print json_encode($addedFriend);
    return;
}

if ($action == "Decline")
{
    declineFriendship($_SESSION['loggedInUser']['u_id'], $_POST['u_id']);
    print json_encode($_POST['u_id']);
    return;
}


if ($action == "Unfriend")
{
    unFriend($_SESSION['loggedInUser']['u_id'], $_POST['u_id']);
    print json_encode($_POST['u_id']);
    return;

}

if ($action == "Regret button")
{
    regretAndBecomeFriends($_SESSION['loggedInUser']['u_id'], $_POST['u_id']);
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



