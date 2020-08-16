<?php 

include "helper_login.php";
include "helpers.php";
include "lib/adodb5/adodb.inc.php";
include "db.php";

if (!empty($_GET['id'])) {
    
    $rs = $db->execute( 'DELETE Funcionario.*, Instrutor.* FROM Funcionario, Instrutor WHERE Funcionario.idFuncionario = \'' . $_GET['id'] . '\' AND Instrutor.idFuncionario = Funcionario.idFuncionario' );
    $rows_affected = $db->affected_rows();
    
    echo $rows_affected;
}
?>