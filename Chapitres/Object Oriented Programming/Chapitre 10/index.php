<?php

require_once 'database.php';
require_once 'user.php';

$database = new Database();

$db = $database->getConnection();

$user = new User($db);
$user->name = "marwan";
$user->email = "marwan@gmail.com";
$user->create();


$liste = $user->read();

foreach($liste as $u){
    echo $u['name']."-".$u['email']."<br>";
}