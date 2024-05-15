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
    case 'login':
        include 'login.php';
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


include 'layout/html_footer.php';
//include 'layout/footer.php';
?>