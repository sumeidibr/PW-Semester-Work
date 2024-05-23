<?php

session_start();
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $message_type = $_SESSION['message_type'];
    echo "<script>alert('$message');</script>";
    // Limpa a mensagem após exibir
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
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
    case 'perfil':
        include 'perfil.php';
        break;
    case 'historico':
        include 'historico.php';
        break;
    case 'produto':
        include 'produto.php';
        break;
    default:
        include 'error_page.php';
        break;
    }

//include 'atualizacao_dados.php';

//include 'layout/footer.php';
include 'layout/html_footer.php';

?>