<?php 
include "helper_login.php";
include "helpers.php";
include "lib/adodb5/adodb.inc.php";
include "db.php";

if (!empty( $_GET )) {
    
    $comm          = "SELECT * FROM ". $mydb . ".Cliente WHERE Cliente.cpf = '" . preg_replace('/[\s.,-]+/', "", $_GET['cpf']) . "'";
    $rs            = $db->execute( $comm );
    $rows_affected = $db->affected_rows();
    
    if($rows_affected == '0') {
        
        $data_registro = new DateTime('');
        $proximo_pagamento_data = $data_registro;
        $data_registro = date_format($data_registro, 'Y-m-d h:m:s');
        
        if($_GET["tipo-plano"] == 0) {
            $total_dias_ferias = '30';
            $proximo_pagamento_data->modify('+1 year');
        } else {
            $total_dias_ferias = '0';
            $proximo_pagamento_data->modify('+1 month');
        }
        $proximo_pagamento_data = date_format($proximo_pagamento_data, 'Y-m-d h:m:s');
        
        $comm = "INSERT INTO `". $mydb . "`.`Cliente` (`nome`, `cpf`, `rg`, `endereco`, `tipoPlano`, `diasFeriasUtilizado`, `diasFeriasRestante`) VALUES ('" . $_GET["nome"] . "', '" . preg_replace('/[\s.,-]+/', "", $_GET['cpf']) . "', '" . preg_replace('/[\s.,-]+/', "", $_GET['rg']) . "', '" . $_GET["endereco"] . "', '" . $_GET["tipo-plano"] . "', '0', '" . $total_dias_ferias . "')";
        $comm2 = "INSERT INTO `". $mydb . "`.`Pagamento` (`idCliente`, `dataPagamento`, `dataProximoPagamento`, `statusPagamento`) VALUES (LAST_INSERT_ID(), '', '" . $proximo_pagamento_data . "', '0')";
        
        $db->beginTrans();
        $rs = $db->execute( $comm );
        if ($rs) {
            $rows_affected = (int) $db->affected_rows();
            $rs2 = $db->execute( $comm2 );
            $rows_affected = $rows_affected + (int) $db->affected_rows();
        } else {
            $db->rollbackTrans();
        }
        $db->commitTrans();
        echo $rows_affected;
    } else {
        echo 'exists';
    }
}
?>