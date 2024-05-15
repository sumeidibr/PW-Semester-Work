<?php
include '../payment.php';
include 'carrinho.php.php';
include 'inicio.php';
session_start();

$payment = new Payment();

var_dump($_POST);
$phone_number = "258" . $_POST['celular']; // Prefixed with country code (258)
$amount = $_POST['valor']; // Payment amount
$reference_id = $_POST['referencia'];

$result = $payment->pay($phone_number, $amount, $reference_id);
if ($result == 200 or $result == 201) {
    if (isset($_GET['efectuar_pagamento']) && isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
        $obj->EXE_NON_QUERY('START TRANSACTION');


        // Calcula o total da compra
        $total = 0;
        foreach ($_SESSION['carrinho'] as $produto_carinho) {
            $total += $produto_carinho['preco'] * $produto_carinho['quantidade'];
        }

        // Insere os detalhes da compra na tabela 'compra'
        $query_compra = 'INSERT INTO compra (iduser, data, localizacao_entrega, total) VALUES (:iduser, NOW(), :localizacao_entrega, :total)';
        $params_compra = array(
            ':iduser' => $_SESSION['user']['id'],
            ':localizacao_entrega' => 'Magoanine',
            ':total' => $total
        );
        $obj->EXE_NON_QUERY($query_compra, $params_compra);

        // Recupera o idcompra
        $idcompra = $obj->EXE_QUERY('SELECT LAST_INSERT_ID() as idcompra')[0]['idcompra'];

        // Insere os produtos associados à compra na tabela 'produto_has_compra'
        $query_prod_comp = 'INSERT INTO produto_has_compra (idproduto, idcompra, quantidade) VALUES (:idproduto, :idcompra, :quantidade)';
        foreach ($_SESSION['carrinho'] as $produto_carinho) {
            $params_prod_comp = array(
                ':idproduto' => $produto_carinho['id'],
                ':idcompra' => $idcompra,
                ':quantidade' => $produto_carinho['quantidade']
            );
            $obj->EXE_NON_QUERY($query_prod_comp, $params_prod_comp);

            // Abate o estoque do produto removido
            $query_abater_estoque = 'UPDATE produto SET estoque = estoque - :quantidade WHERE idproduto = :idproduto';
            $params_abater_estoque = array(
                ':quantidade' => $produto_carinho['quantidade'],
                ':idproduto' => $produto_carinho['id']
            );
            $obj->EXE_NON_QUERY($query_abater_estoque, $params_abater_estoque);
        }

        // Limpa o carrinho após o pagamento ser efetuado
        unset($_SESSION['carrinho']);
        echo "<p style='color: green; padding: 10px'>Pagamento efectuado com sucesso!</p>";
    } else {
        var_dump($_SESSION['carrinho']);
        var_dump($_GET['efectuar_pagamento']);
        echo 'Erro ao processar pagamento: ';
        echo "<p style='color: red; padding: 10px'>Erro ao efectuar o pagamento!</p>";
    }
}
