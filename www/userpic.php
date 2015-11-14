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

function get_file_and_send($filename)
{
    if (!$filename) {
        $path = $_SERVER['DOCUMENT_ROOT']."/images/anonymous.jpg";
    } else {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/../user_uploads/" . $filename;
    }
    $content = file_get_contents($path);
    header("Content-Type: image/jpeg");
    return $content;
}

if(is_logged_in()) {
    $user = selectUser($_GET['u_id']);
    if($_GET['type'] === 'public') {
        print get_file_and_send($user['u_picture']);
    }
    else if (($_GET['type'] === 'private') && (is_user_permitted_to_see_the_file($_SESSION['loggedInUser']['u_id'], $_GET['u_id']))) {
        print get_file_and_send($user['u_secret_pic']);
    }
}




