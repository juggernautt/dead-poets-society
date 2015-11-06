<?php
/**
 * Created by PhpStorm.
 * User: juggernautt
 * Date: 11/6/15
 * Time: 4:13 PM
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');

session_start();
is_logged_in();

//print_r($_SESSION);
//die;

//if (is_user_permitted_to_see_the_file())

$path = getcwd().$_GET['file'];
$content = file_get_contents($path);

header("Content-Type: image/jpeg");
print $content;
