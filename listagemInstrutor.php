<?php 
include "helper_login.php";
include "helpers.php";
include "lib/adodb5/adodb.inc.php";
include "db.php";

$view                  = file_get_contents( "views/listagemInstrutor.tmpl" );
$view_row_instrutor    = file_get_contents( "views/inc/listagemInstrutor_linha.tmpl" );
$view_header_instrutor = file_get_contents( "views/inc/listagemInstrutor_header.tmpl" );

$menu                  = include "menu.php";
$view                  = str_replace("<@MENU>", $menu, $view);

$rs                    = $db->execute('SELECT * FROM Funcionario, Instrutor WHERE Funcionario.idCargo = 3 AND Instrutor.idFuncionario = Funcionario.idFuncionario');
$results               = $rs->getRows();

if(!empty($results)) {
    
    $rows_instrutor = "";
    for ($i=0; $i < count( $results ); $i++) { 
               
        $html_row = $view_row_instrutor;
        $html_row = str_replace("<@CPF_INSTRUTOR>", preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $results[$i]['cpf']), $html_row);
        $html_row = str_replace("<@RG_INSTRUTOR>", preg_replace("/(\d{2})(\d{3})(\d{3})(\d{1})/", "\$1.\$2.\$3-\$4", $results[$i]['rg']), $html_row);
        $html_row = str_replace("<@NOME_INSTRUTOR>", $results[$i]['nome'], $html_row);
        $html_row = str_replace("<@ATIVIDADE_INSTRUTOR>", $tipoAula[$results[$i]['tipoAula']], $html_row);
        $html_row = str_replace("<@ID_INSTRUTOR>", $results[$i]['idFuncionario'], $html_row);
        
        $rows_instrutor .= $html_row;
        
    }
    $view = str_replace("<@HEADER_INSTRUTORES>", $view_header_instrutor, $view);
    $view = str_replace("<@ROWS_INSTRUTORES>", $rows_instrutor, $view);

} else {
    $view = str_replace("<@HEADER_INSTRUTORES>", "", $view);
    $view = str_replace("<@ROWS_INSTRUTORES>", "<br><br><p style=\"text-align:center;\">Ainda sem instrutores!</p>", $view);
}

print($view);
?>