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
require_once('lib/AL.php');

$al = new AL($config['database']);
//$result = $al->select_many('users', array('u_is_frozen_account' => 0, 'u_password' => md5('1234')));

//$props = array(
//    'u_id1' => 3,
//    'u_id2' => 6,
//    'r_status' => 'FRIENDS'
//);
//
//$preds = array(
//    'u_id1' => 6,
//    'u_id2' => 3,
//    'r_status' => 'REQUEST_SENT'
//);

//$result = $al->update_many('relationship', $preds, $props);


//$predicates = array(
//    'u_id' => 1,
//    'p_id' => 1
//);

//$result = $al->delete_many('posts', $predicates);
//var_dump($result);
