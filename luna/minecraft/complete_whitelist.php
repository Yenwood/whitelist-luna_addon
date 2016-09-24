<?php

define('LUNA_ROOT', dirname(__DIR__).'/');
require LUNA_ROOT.'include/common.php';

$uuid = $_GET["uuid"];

if(!$uuid || strlen($uuid) != 32 || preg_match('/[^abcdefghijklmnopqrstuvwxyz1234567890]/', $uuid)){
    die();
}

// Add UUID to the user
//UPDATE `luna`.`lunausers` SET `uuid` = '1' WHERE `lunausers`.`id` = 2;
$result = $db->query('UPDATE `'.$db_name.'`.`'.$db_prefix.'users` SET `uuid` = \''.$uuid.'\' WHERE `id` = '.$luna_user["id"]) or error('Unable to!', __FILE__, __LINE__, $db->error());