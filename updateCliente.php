<?php 
include "helper_login.php";
include "helpers.php";
include "lib/adodb5/adodb.inc.php";
include "db.php";

if (!empty( $_GET )) {
        
        $ferias_restante = $_GET["ferias-dias-restantes"];
        $ferias_inicio   = $_GET["ferias-inicio"];
        $ferias_fim      = $_GET["ferias-final"];
        if($_GET["tipo-plano"] == 1) {
                $ferias_restante = 0;
                $ferias_inicio = "";
                $ferias_fim = "";

        } elseif ($_GET["tipo-plano"] == 0 && $ferias_restante == '0') {
                $ferias_restante = 30;
        }        
        
        $comm = "UPDATE `". $mydb . "`.`Cliente` SET `nome` = '" . $_GET["nome"] . "', `endereco` = '" . $_GET["endereco"] . "', `tipoPlano` = '" . $_GET["tipo-plano"] . "', `feriasInicio` = '" . $ferias_inicio . "', `feriasFim` = '" . $ferias_fim . "', `diasFeriasRestante` =  '" . $ferias_restante . "' WHERE (`idCliente` = '" . $_GET["id"] . "')";
        $rs = $db->execute( $comm );
        $rows_affected = $db->affected_rows();
        
        echo $rows_affected;       
}
?>