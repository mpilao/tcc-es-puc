<?php 
include "helper_login.php";
include "helpers.php";
include "lib/adodb5/adodb.inc.php";
include "db.php";

if (!empty( $_GET )) {
        
        $comm = "UPDATE `". $mydb . "`.`Funcionario` SET `nome` = '" . $_GET["nome"] . "', `rg` = '" . preg_replace('/[\s.,-]+/', "", $_GET['rg']) . "' WHERE (`idFuncionario` = '" . $_GET["id"] . "');";
        $comm2 = "UPDATE ". $mydb . ".Instrutor SET `tipoAula` = '" . $_GET["tipo-aula"] . "' WHERE `idFuncionario` = '" . $_GET["id"] . "'";

        $db->beginTrans();
        $rs = $db->execute( $comm );
        if ($rs) {
            $rows_affected = (int) $db->affected_rows();
            $rs2 = $db->execute( $comm2 );
            $rows_affected = $rows_affected + (int) $db->affected_rows();
            echo $rows_affected;
        } else {
            $db->rollbackTrans();
        }
        $db->commitTrans();
}
?>