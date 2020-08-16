<?php
$menu = '';
$menu_links = '';


    if( $_COOKIE["usuario"] == "Recepcionista" ) {
        $menu_links = '
        <li class="nav-item">
            <a class="nav-link" href="listagemCliente.php" title="Clientes">Clientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="listagemInstrutor.php" title="Instrutores">Instrutores</a>
        </li>';
    } else if ($_COOKIE["usuario"] == "Gerente") {
        $menu_links = '
        <li class="nav-item">
            <a class="nav-link" href="listagemRelatorioCliente.php" title="Clientes">Clientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="listagemRelatorioClienteInadimplente.php" title="Inadimplentes">Inadimplentes</a>
        </li>';
    } else {

    }


    return '
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top justify-content-between">
        <a class="navbar-brand" href="#" title="Academia Movimento">
        <img class="img-responsive" src="assets/img/academia_movimento_logo.png" alt="" width="60">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                ' . $menu_links . '
            </ul>
            <ul class="navbar-nav col-sm-1">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ' . $_COOKIE["usuario"] . '
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="sair.php">Sair</a>
                    </div>
                </li>
            </ul>
        </div>
        </nav>';
?>