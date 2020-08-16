<?php 
$server = '127.0.0.1';
$user     = 'root';
$password = 'password';
$mydb = 'movimento';

$db = adoNewConnection('mysqli');
// $db->debug = true;
$db->connect($server, $user, $password, $mydb);

?>