<?php

$username = $_GET["username"];
$url = "https://api.mojang.com/users/profiles/minecraft/" . urlencode($username);
$content = file_get_contents($url);
$json = json_decode($content);
echo $json->id;