<?php
include 'gestor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber dados do formulário
    $usuario = $_POST["txt_usuario"];
    $senha = $_POST["txt_senha"];
    $tipo = 'cliente';

  
    // Instanciar a classe Gestor
    $obj = new Gestor();

    // Hash da senha
    $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

    // Parâmetros para a query preparada
    $params = array(
        ':usuario' => $usuario,
        ':type' => $tipo,
        ':senha' => $senha_hashed
    );

    // Executar a query
    $obj->EXE_NON_QUERY('INSERT INTO users VALUES (0, :usuario, :type, :senha)', $params);

    // Mensagem de conclusão
    echo  header("Location: inicio.php");;
} else {
    // Se o formulário não foi enviado corretamente, redirecionar para o formulário
    header("Location: formulario.php");
    exit();
}
?>
