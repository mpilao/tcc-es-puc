<?php 
include "helper_login.php";

include "helpers.php";
include "lib/adodb5/adodb.inc.php";
include "db.php";

$view               = file_get_contents( "views/listagemCliente.tmpl" );
$view_row_client    = file_get_contents( "views/inc/listagemCliente_linha.tmpl" );
$view_header_client = file_get_contents( "views/inc/listagemCliente_header.tmpl" );

$menu               = include "menu.php";
$view               = str_replace("<@MENU>", $menu, $view);

$rs                 = $db->execute("SELECT * FROM Cliente, Pagamento WHERE Cliente.idCliente = Pagamento.idCliente ORDER BY Cliente.idCliente DESC");
$results            = $rs->getRows();

if(!empty($results)) {
    
    $rows_client = "";
    for ($i=0; $i < count( $results ); $i++) { 
        
        $html_row = $view_row_client;
        $html_row = str_replace("<@MATRICULA_CLIENTE>", $results[$i]['idCliente'], $html_row);
        $html_row = str_replace("<@NOME_CLIENTE>"     , $results[$i]['nome'], $html_row);
        $html_row = str_replace("<@CPF_CLIENTE>"      , preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $results[$i]['cpf']), $html_row);
        $html_row = str_replace("<@RG_CLIENTE>"       , preg_replace("/(\d{2})(\d{3})(\d{3})(\d{1})/", "\$1.\$2.\$3-\$4", $results[$i]['rg']), $html_row);
        $html_row = str_replace("<@PLANO_CLIENTE>"    , $tipo_plano[$results[$i]['tipoPlano']], $html_row);
        $html_row = str_replace("<@STATUS_CLIENTE>"   , $status_pagamento[$results[$i]['statusPagamento']], $html_row);
        $html_row = str_replace("<@ID_CLIENTE>"       , $results[$i]['idCliente'], $html_row);
        
        $rows_client .= $html_row;
        
    }
    $view = str_replace("<@HEADER_CLIENTES>", $view_header_client, $view);
    $view = str_replace("<@ROWS_CLIENTES>", $rows_client, $view);
    
    
} else {
    $view = str_replace("<@HEADER_CLIENTES>", "", $view);
    $view = str_replace("<@ROWS_CLIENTES>", "<br><br><p style=\"text-align:center;\">Ainda sem clientes!</p>", $view);
}

print($view);
?>