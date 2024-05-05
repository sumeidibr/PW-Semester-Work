<style>
    .search {
        margin-top: 10px;
        display: flex;
        text-align: center;
        justify-content: right;
        margin-right: 15px;
    }

    .search input[type="text"] {
        margin-right: 10px;
        /* Espaçamento entre o campo de busca e o botão de pesquisa */
    }

    .search button {
        background-color: #007bff;
        /* Cor de fundo do botão */
        color: #fff;
        /* Cor do texto do botão */
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    .search button:hover {
        background-color: #0056b3;
        /* Cor de fundo do botão ao passar o mouse */
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .card {
        width: 250px;
        margin: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }

    .card img {
        width: 100%;
        height: auto;
        border-radius: 5px;
    }

    .info {
        margin-top: 10px;
    }

    .nome {
        font-weight: bold;
    }

    .preco {
        font-size: 18px;
        color: #ff5722;
        /* laranja */
    }

    .botao {
        display: block;
        width: 90%;
        padding: 10px;
        margin-top: 10px;
        text-align: center;
        background-color: #ff5722;
        /* laranja */
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .botao:hover {
        background-color: #f44336;
        /* laranja mais escuro */
    }
</style>
<?php
include 'gestor.php';
$obj = new Gestor();

$sql = 'SELECT * FROM produto';
$result = $obj->EXE_QUERY($sql);

?>


<div style="height: 900px; width:100%; background-color:antiquewhite;">


    <div class="container">
        <?php foreach ($result as $produto) : ?>
            <?php if ($produto['estoque'] >= 1) { ?>
                <div class="card">
                    <img src="<?php echo $produto['imagem'] ?>" alt="imagem_produto">
                    <div class="info">
                        <p class="nome"><?php echo $produto['nome'] ?></p>
                        <p>Quantidade: <?php echo $produto['estoque'] ?> </p>
                        <p>Descricao: <?php echo $produto['descricao'] ?> </p>
                        <?php

                        $hoje = date('Y-m-d');

                        $sql_promocao = 'SELECT * FROM produto_has_promocao WHERE idProduto = :id_produto AND :hoje BETWEEN Data_Inicio AND Data_Fim';
                        $params_promocao = array(':id_produto' => $produto['idproduto'], ':hoje' => $hoje);

                        $resultado_promocao = $obj->EXE_QUERY($sql_promocao, $params_promocao);
                        echo  '<p class="preco">Preço Normal: ' . $produto['preco'] . 'MT</p>';

                        if ($resultado_promocao) {
                            // var_dump($resultado_promocao);
                            //die();
                            echo 'PROMOCAO: <br>';
                            echo 'Desconto: ' . $resultado_promocao[0]['desconto'] . '% <hr>';
                            echo '<p class="preco">Preço Com Desconto: ' . ($produto['preco'] - ($produto['preco'] * ($resultado_promocao[0]['desconto'] / 100))) . ' MT</p>';
                            // O produto está em promoção
                        } else {
                            //echo 'nopnop';
                            // O produto não está em promoção
                        }
                        ?>
                    </div>

                    <a href="?p=login" class="botao">Add Carrinho</a>
                </div>
            <?php } ?>
        <?php endforeach; ?>
    </div>
</div>

