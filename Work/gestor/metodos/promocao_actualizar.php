<?php
include '../../gestor.php';
$obj = new Gestor();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id =$_POST["id"] ;
    $descricao = $_POST["descricao"];
    $nome = $_POST["nome"];


    $params = array(
        ':id' => $id,
        ':descricao' => $descricao,
        ':nome' => $nome
    );


    $obj->EXE_NON_QUERY('UPDATE promocao SET descricao = :descricao, nome = :nome WHERE idpromocao = :id', $params);
    echo 'Atualizado com sucesso';
    Header('Location: ../index.php');
}
