<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/html5reset-1.6.1.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Meddon' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
</head>
<body>
<header>


        <nav>
            <div>
                <?php if (isset($_SESSION['loggedInUser'])) { ?>
                    <span class="logout">
                    <img src="<?= getUserPic($_SESSION['loggedInUser']['u_picture']); ?>" width="35"
                         height="45"><?= $_SESSION['loggedInUser']['u_nickname']; ?>
                        <a href="/logout.php">Log out</a>
            </span>
                <?php } ?>
                <ul class="nav nav-tabs right">
                    <li role="presentation"><a href="/index.php">Home</a></li>
                    <li role="presentation"><a href="/friends.php?show=all">Find Friends</a></li>
                    <li role="presentation"><a href="/friends.php?show=only-mine">My Friends</a></li>
                    <li role="presentation"><a href="/relationship.php">Relationships</a></li>
                    <li role="presentation"><a href="/userinfo.php">Settings</a></li>
                </ul>
            </div>
        </nav>
    <div class="container" id="logo">
            <a href="/index.php"><img src="/images/poe.jpg" width="100" height="100"></a>
            <h1>Dead Poets Society
                <small>Anti social network</small>
            </h1>
            <span>The country of poets and thinkers</span>
    </div>

</header>