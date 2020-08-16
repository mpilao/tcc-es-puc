<?php
include "helper_login.php";
include "helpers.php";
include "lib/adodb5/adodb.inc.php";
include "db.php";

$view = file_get_contents( "views/editarInstrutor.tmpl" );
$form = file_get_contents( "views/inc/formEditarInstrutor.tmpl" );

$menu = include "menu.php";
$view = str_replace("<@MENU>", $menu, $view);

if (!empty( $_GET )) {
    
    $comm = "SELECT * FROM Funcionario, Instrutor WHERE Funcionario.idCargo = 3 AND Instrutor.idFuncionario = Funcionario.idFuncionario AND Funcionario.idFuncionario = '" . $_GET['id'] . "'";
    $rs = $db->execute( $comm );
    $results = $rs->getRows();
    
    if(!empty($results)) {
        
        for ($i=0; $i < count( $results ); $i++) { 
            
            $id        = $_GET['id'];
            $nome      = $results[$i]["nome"];            
            $cpf       = $results[$i]["cpf"];
            $cpf       = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cpf);
            $rg        = $results[$i]["rg"];
            $rg        = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{1})/", "\$1.\$2.\$3-\$4", $rg);
            $tipo_aula = $results[$i]["tipoAula"];
            
            $form = str_replace("<@ID_INSTRUTOR>", $id, $form);
            $form = str_replace("<@NOME_INSTRUTOR>", $nome, $form);
            $form = str_replace("<@CPF_INSTRUTOR>", $cpf, $form);
            $form = str_replace("<@RG_INSTRUTOR>", $rg, $form);
            $form = str_replace("<@TIPO_AULA_INSTRUTOR>", $tipo_aula, $form);
            $view = str_replace("<@TIPO_AULA_INSTRUTOR>", $tipo_aula, $view);
            
            $view = str_replace("<@FORM_INSTRUTOR>", $form, $view);
            
        }
    } else {
        $view = str_replace("<@FORM_INSTRUTOR>", "<br><br><p style=\"text-align:center;\">Entrada de Instrutor inválida!</p>", $view);
    }
} 
print($view);
?>