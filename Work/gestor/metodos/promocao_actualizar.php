<?php
include '../../gestor.php';
$obj = new Gestor();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract POST data
    // $id_produto = $_POST["id_produto"];
    $id_produto = 10;
    $descricao = $_POST["descricao"];
    $desconto = $_POST["desconto"];
    $dataInicio = $_POST["dataInicio"];
    $dataFim = $_POST["dataFim"];
    $dataFim = $_POST["dataFim"];
    $status = $_POST["status"];
    $idpromocao = $_POST["idpromocao"];

    $params = array(
        ':idpromocao' => $idpromocao,
        ':descricao' => $descricao,
        ':desconto' => $desconto,
        ':data_inicio' => $dataInicio,
        ':data_fim' => $dataFim,
        ':statuspro' => $status,
        ':id_produto' =>  $id_produto

    );


    $obj->EXE_NON_QUERY('UPDATE promocao SET descricao = :descricao, desconto = :desconto, data_inicio = :data_inicio, data_fim = :data_fim, status_pro = :statuspro, id_produto = :id_produto WHERE idpromocao = :idpromocao', $params);
    echo 'Atualizado com sucesso';
    Header('Location: ../index.php');
}
