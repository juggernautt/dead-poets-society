<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');

session_start();
session_destroy();
session_unset();
$_SESSION = null;

redirect('/login.php');
