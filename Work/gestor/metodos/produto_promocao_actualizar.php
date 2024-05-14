<?php

include '../../gestor.php';

$obj = new Gestor();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $id_promocao = $_POST["id_promocao"];
    $desconto = $_POST["desconto"];
    $dataInicio = $_POST["dataInicio"];
    $dataFim = $_POST["dataFim"];
    $status = $_POST["update_status"];
    $id_produto = $_POST["id_produto"];

    $sql_update = 'UPDATE produto_has_promocao SET Data_Inicio = :data_inicio, Data_Fim = :data_fim, desconto = :desconto, estado = :estado, idProduto = :id_produto, idPromocao = :id_promocao WHERE idAssociacao = :id';
    $params_update = array(
        ':data_inicio' => $dataInicio,
        ':data_fim' => $dataFim,
        ':desconto' => $desconto,
        ':estado' => $status,
        ':id_produto' =>  $id_produto,
        ':id_promocao' => $id_promocao,
        ':id' => $id
    );
    $obj->EXE_NON_QUERY($sql_update, $params_update);
    echo "<script> alert('Sucesso.')</script>";
    Header('Location: ../index.php');
}
