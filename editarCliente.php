<?php
include "helper_login.php";
include "helpers.php";
include "lib/adodb5/adodb.inc.php";
include "db.php";

$view = file_get_contents( "views/editarCliente.tmpl" );
$form = file_get_contents( "views/inc/formEditarCliente.tmpl" );

$menu = include "menu.php";
$view = str_replace("<@MENU>", $menu, $view);

if (!empty( $_GET )) {
    
    $comm = "SELECT * FROM ". $mydb . ".Cliente WHERE Cliente.idCliente = '" . $_GET['id'] . "'";
    $rs = $db->execute( $comm );
    $results = $rs->getRows();

    if(!empty($results)) {

        for ($i=0; $i < count( $results ); $i++) { 
            
            $id              = $_GET['id'];
            $nome            = $results[$i]["nome"];
            $cpf             = $results[$i]["cpf"];
            $cpf             = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cpf);
            $rg              = $results[$i]["rg"];
            $rg              = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{1})/", "\$1.\$2.\$3-\$4", $rg);     
            $endereco        = $results[$i]["endereco"];
            $plano           = $results[$i]["tipoPlano"];            
            $biometria       = "efewjbfjewbkf";
            $ferias          = (int) $results[$i]["diasFeriasRestante"];
            $ferias_usadas   = (int) $results[$i]["diasFeriasUtilizado"];
            $ferias_restante = $ferias - $ferias_usadas;
            $ferias_inicio   = $results[$i]["feriasInicio"];
            $ferias_fim      = $results[$i]["feriasFim"];
            
            $form = str_replace("<@ID_CLIENTE>"                , $id, $form);
            $form = str_replace("<@NOME_CLIENTE>"              , $nome, $form);
            $form = str_replace("<@CPF_CLIENTE>"               , $cpf, $form);
            $form = str_replace("<@RG_CLIENTE>"                , $rg, $form);
            $form = str_replace("<@ENDERECO_CLIENTE>"          , $endereco, $form);
            $form = str_replace("<@TIPO_PLANO_CLIENTE>"        , $plano, $form);
            $view = str_replace("<@TIPO_PLANO_CLIENTE>"        , $plano, $view);
            $form = str_replace("<@FERIAS_UTILIZADAS_CLIENTE>" , $ferias_usadas, $form);
            $form = str_replace("<@FERIAS_DISPONIVEIS_CLIENTE>", $ferias_restante, $form);
            $form = str_replace("<@FERIAS_INICIO_CLIENTE>"     , $ferias_inicio, $form);
            $form = str_replace("<@FERIAS_FIM_CLIENTE>"        , $ferias_fim, $form);
            $form = str_replace("<@DIA_AMANHA>"                , $dia_amanha, $form);
            $form = str_replace("<@BIOMETRIA_CLIENTE>"         , $biometria, $form);
            $view = str_replace("<@FORM_CLIENTE>"              , $form, $view);

        }
    } else {
            $view = str_replace("<@FORM_CLIENTE>", "<br><br><p style=\"text-align:center;\">Entrada de Cliente inválida!</p>", $view);
    }
    
    print($view);
}
?>