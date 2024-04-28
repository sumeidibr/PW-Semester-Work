<?php
include 'gestor.php';
session_start();
$obj = new Gestor();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $obj = new Gestor();
    $apelido = $_POST["apelido"];
    $pnome = $_POST["pnome"];
    $email = $_POST["email"];
    $tipo_user = $_POST["tipo_user"];
    $senha = $_POST["senha"];
    
    $params = array(
        ':primeiro_nome' => $pnome,
        ':apelido' => $apelido,
        ':email' => $email,
        ':senha' => password_hash($senha, PASSWORD_DEFAULT),
        ':tipo_user' => $tipo_user,
        ':icon' => null
    );
    $sql = 'INSERT INTO user VALUES (0, :primeiro_nome, :apelido, :email, :senha, :tipo_user, :icon)';
    $obj->EXE_NON_QUERY($sql, $params);

    echo 'sucess';
    $_SESSION['user'] = $pnome;

    header("Location: cliente/index.php");
} else {
    echo "nada";
}
