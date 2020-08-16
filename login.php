<?php     
    $failed = "";
    setcookie("login", "", time() - 3600);

    if( count($_POST) > 0 ) {
        
        if($_POST["email"] == "recepcao@movimentoacademia.com.br" && $_POST["pass"] == "123456") {
              header('Location: listagemCliente.php');
              setcookie("login", true);
              setcookie("usuario", "Recepcionista");
        } elseif ($_POST["email"] == "gerencia@movimentoacademia.com.br" && $_POST["pass"] == "123456") {
              header('Location: listagemRelatorioCliente.php');
              setcookie("login", true);
              setcookie("usuario", "Gerente");
        } else {
            
            $failed = "Desculpe, usuário ou senha inválido!";
            $view = file_get_contents( "views/login.tmpl" );
            $view = str_replace("<@ERROR_MSG>", $failed, $view);
            $view = str_replace("<@EMAIL_USER>", $_POST["email"], $view);
        
            print($view);
        }
    } else {
        $view = file_get_contents( "views/login.tmpl" );
        $view = str_replace("<@ERROR_MSG>", $failed, $view);
        $view = str_replace("<@EMAIL_USER>", "", $view);
        
        print($view);
    }
    
    
?>