<?php
/**
 * Created by PhpStorm.
 * User: juggernautt
 * Date: 11/14/15
 * Time: 4:21 PM
 */
$_SERVER['DOCUMENT_ROOT'] = "./www/";
//
require_once('includes/init.php');
//require_once('lib/AL.php');
//require_once('lib/businessLogic.php');
//
//print_r(selectUser(3));
//print_r(deactivateProfile(3));
//print_r(addFriend(3, 2));

//

//$al = new AL($config['database']);
//var_dump($al->select_one('posts', 106));
//

print_r(array_fill(0, 5, "?"));


/// INSERT INTO users (u_name, u_two, ...) VALUES (?, ?, ?, ?)



//$sqlStatement = "UPDATE users SET u_password=MD5('123456'), u_nickname='Boffin2' WHERE u_id=13";
//$PDOStatement = $db->prepare($sqlStatement);
//$queryResult = $PDOStatement->execute();
//
//if ($queryResult) {
//    $user = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
//}
//
//print_r($user);
