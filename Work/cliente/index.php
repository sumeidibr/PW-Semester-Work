<?php

session_start();

include 'layout/html_header.php';
include 'layout/nav.php';

include 'layout/user.php';

$pagina = 'inicio';
// Verificar se existe 
if (isset($_GET['p'])) {
    $pagina = $_GET['p'];
}

switch($pagina){

    // logout
    case 'logout':
        session_destroy();
        Header('Location:  ../index.php');
        break;
    case 'inicio':
        include 'inicio.php';
        break;
    case 'login':
        include 'login.php';
        break;
    case 'carrinho':
        include 'carrinho.php';
        break;
    case 'sobre':
        include 'sobre.php';
        break;
    case 'produto':
        include 'produto.php';
        break;
    default:
        include 'error_page.php';
        break;
    }

include 'layout/footer.php';
include 'layout/html_footer.php';
