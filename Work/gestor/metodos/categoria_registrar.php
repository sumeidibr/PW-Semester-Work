<?php
include '../../gestor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome_categoria'];
    $descricao = $_POST['descricao_categoria'];
    $tipo_cliente = $_POST['tipo_cliente'];

    $obj = new Gestor();

    $params = array(
        ':nome' => $nome,
        ':disc' => $descricao,
        ':tipo_cliente' => $tipo_cliente
    );

    // Consulta SQL para inserção de dados
    $sql = 'INSERT INTO categoria VALUES (0, :nome, :disc, :tipo_cliente)';

    $obj->EXE_NON_QUERY($sql, $params);
    Header('Location: ../index.php');
}
