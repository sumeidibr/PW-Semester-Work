<?php
session_start();


include 'layout/html_header.php';
include 'layout/nav.php';


$pagina = 'inicio';
// Verificar se existe 
if (isset($_GET['p'])) {
    $pagina = $_GET['p'];
}

switch($pagina){

    // logout
    case 'logout':
        break;
    case 'inicio':
        include 'inicio.php';
        break;
    case 'promocao':
        include 'promocao.php';
        break;
    case 'cliente':
        include 'cliente.php';
        break;
    case 'produto':
        include 'produto.php';
        break;
    case 'categoria':
        include 'categoria.php';
        break;
    default:
        include 'error_page.php';
        break;
    }

include 'layout/footer.php';
include 'layout/html_footer.php';
