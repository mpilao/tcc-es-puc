<?php 
include "helper_login.php";
include "helpers.php";
include "lib/adodb5/adodb.inc.php";
include "db.php";

if (!empty( $_GET )) {

    $comm          = "SELECT * FROM ". $mydb . ".Funcionario WHERE Funcionario.cpf = '" . preg_replace('/[\s.,-]+/', "", $_GET['cpf']) . "'";
    $rs            = $db->execute( $comm );
    $rows_affected = $db->affected_rows();

    if($rows_affected == '0') {

        $comm  = "INSERT INTO Funcionario (nome, cpf, rg, idCargo) VALUES('" . $_GET["nome"] . "', '" . preg_replace('/[\s.,-]+/', "", $_GET['cpf']) . "', '" . preg_replace('/[\s.,-]+/', "", $_GET['rg']) . "', '3');";
        $comm2 = "INSERT INTO Instrutor (idFuncionario, tipoAula) VALUES(LAST_INSERT_ID(),'" . $_GET["tipoAula"] . "');";
    
        $db->beginTrans();
        $rs = $db->execute( $comm );
        if ($rs) {
            $rs2 = $db->execute( $comm2 );
            $rows_affected = $db->affected_rows();
            echo $rows_affected;
        } else {
            $db->rollbackTrans();
        }
        $db->commitTrans();
    } else {
        echo 'exists';
    }
}
?>