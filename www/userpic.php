<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');

session_start();
is_logged_in();

function is_user_permitted_to_see_the_file($id1, $id2) {
    if($id1 === $id2 || getRelationshipStatus($id1, $id2) === FRIENDS) {
        return true;
    }
    return false;
}




if(($_GET['type'] === 'public') || (is_user_permitted_to_see_the_file($_SESSION['loggedInUser']['u_id'], $_GET['u_id']))) {
    $path = getcwd() . $_GET['u_id'] . '&' . $_GET['type'];
    $content = file_get_contents($path);
    header("Content-Type: image/jpeg");
    print $content;
}



