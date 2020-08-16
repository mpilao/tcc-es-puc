<?php 

include "helper_login.php";
include "helpers.php";
include "lib/adodb5/adodb.inc.php";
include "db.php";

if (!empty($_GET['id'])) {
    $rs = $db->execute( 'DELETE FROM `'. $mydb . '`.`Cliente` WHERE (`idCliente` = \'' . $_GET['id'] . '\')' );
    $rows_affected = $db->affected_rows();
    
    echo $rows_affected;
}
?>