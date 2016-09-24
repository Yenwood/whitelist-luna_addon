<?php

define('LUNA_ROOT', dirname(__DIR__).'/');
require LUNA_ROOT.'include/common.php';

$uuid = $_GET["uuid"];

if(!$uuid || strlen($uuid) != 32 || preg_match('/[^abcdefghijklmnopqrstuvwxyz1234567890]/', $uuid)){
    die('{"error": "Invalid or missing UUID"}');
}

$result = $db->query('SELECT * FROM `'.$db_prefix.'users` WHERE `uuid` = \''.$uuid.'\' LIMIT 1') or error('Unable to fetch users', __FILE__, __LINE__, $db->error());

if($db->num_rows($result) > 0){
    $row = $db->fetch_assoc($result);
    echo '{"username": "'.$row["username"].'", "whitelisted": true}';
}else{
    echo '{"whitelisted": false}';
}