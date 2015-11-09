<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/businessLogic.php');

session_start();


function is_user_permitted_to_see_the_file($id1, $id2) {
    if($id1 === $id2 || getRelationshipStatus($id1, $id2) === FRIENDS) {
        return true;
    }
    return false;
}

if(is_logged_in()) {
    $user = selectUser($_GET['u_id']);
    if($_GET['type'] === 'public') {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/../user_uploads/" . $user['u_picture'];
        $content = file_get_contents($path);
        header("Content-Type: image/jpeg");
        print $content;


    }
    else if (($_GET['type'] === 'private') && (is_user_permitted_to_see_the_file($_SESSION['loggedInUser']['u_id'], $_GET['u_id']))) {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/../user_uploads/" . $user['u_secret_pic'];
        $content = file_get_contents($path);
        header("Content-Type: image/jpeg");
        print $content;

    }
}




