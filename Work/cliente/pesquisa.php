<?php
include '../gestor.php';

$obj = new Gestor();

$q = isset($_GET['q']) ? $_GET['q'] : '';

$sql = 'SELECT * FROM produto WHERE nome LIKE :nome';
$params = array(':nome' => '%' . $q . '%');
$result = $obj->EXE_QUERY($sql, $params);

if (count($result) > 0) {
    foreach ($result as $produto) {
        if ($produto['estoque'] >= 1) {
            echo '<div class="card">';
            echo '<img src="../' . $produto['imagem'] . '" alt="imagem_produto">';
            echo '<div class="info">';
            echo '<p class="nome">' . $produto['nome'] . '</p>';

            $hoje = date('Y-m-d');
            $sql_promocao = 'SELECT * FROM produto_has_promocao WHERE idProduto = :id_produto AND :hoje BETWEEN Data_Inicio AND Data_Fim';
            $params_promocao = array(':id_produto' => $produto['idproduto'], ':hoje' => $hoje);
            $resultado_promocao = $obj->EXE_QUERY($sql_promocao, $params_promocao);

            echo '<p class="preco">Preço Normal: ' . $produto['preco'] . ' Mzn</p>';

            if ($resultado_promocao) {
                echo 'PROMOCAO: <br>';
                echo 'Desconto: ' . $resultado_promocao[0]['desconto'] . '% <hr>';
                echo '<p class="preco">Preço Com Desconto: ' . ($produto['preco'] - ($produto['preco'] * ($resultado_promocao[0]['desconto'] / 100))) . ' MT</p>';
            }
            echo '</div>';
            echo '<a href="?add_carrinho=' . $produto['idproduto'] . '" class="botao">Adicionar</a>';
            echo '</div>';
        }
    }
} else {
    echo '<p>Nenhum produto encontrado.</p>';
}
?>
