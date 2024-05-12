<?php
include '../../gestor.php';

$obj = new Gestor();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_promocao = $_POST["id_promocao"];
    $desconto = $_POST["desconto"];
    $dataInicio = $_POST["dataInicio"];
    $dataFim = $_POST["dataFim"];
    $status = $_POST["status"];

    // Loop através dos IDs de produto
    foreach ($_POST["id_produto"] as $id_produto) {
        // Verificar se há uma promoção ativa para o produto na data atual
        $hoje = date('Y-m-d');
        $sql_verificar = 'SELECT * FROM produto_has_promocao WHERE idProduto = :id_produto AND :hoje BETWEEN Data_Inicio AND Data_Fim AND estado = 1';
        $params_verificar = array(':id_produto' => $id_produto, ':hoje' => $hoje);
        $resultado_verificar = $obj->EXE_QUERY($sql_verificar, $params_verificar);

        if ($resultado_verificar) {
            // Se houver uma promoção ativa, exiba uma mensagem ou tome outra ação, conforme necessário
            Header('Location: ../index.php');
            echo "<script> alert('Já existe uma promoção ativa para o produto $id_produto na data atual.')</script>";
        } else {
            // Se não houver promoção ativa, insira a nova promoção
            $params = array(
                ':desconto' => $desconto,
                ':data_inicio' => $dataInicio,
                ':data_fim' => $dataFim,
                ':estado' => $status,
                ':id_produto' =>  $id_produto,
                ':id_promocao' => $id_promocao
            ); 
            $sql = 'INSERT INTO produto_has_promocao (idAssociacao, idProduto, idPromocao, Data_Inicio, Data_Fim, desconto,  estado) VALUES (0, :id_produto, :id_promocao, :data_inicio, :data_fim, :desconto, :estado)';
            $obj->EXE_NON_QUERY($sql, $params);
            echo "<script> alert('Sucesso...')</script>";
            Header('Location: ../index.php');
        }
    }
}
