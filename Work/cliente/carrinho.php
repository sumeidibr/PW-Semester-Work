<style>
    /* Estilos CSS */
    .container {
        border-radius: 10px;
        text-align: center;
        /* Centraliza o conteúdo */
    }

    h2 {
        color: #333;
    }

    .produto {
        display: inline-block;
        /* Permite que os produtos sejam exibidos lado a lado */
        margin: 0 10px;
        /* Adiciona um espaço entre os produtos */
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #fff;
        text-align: left;
        /* Alinha o texto à esquerda dentro dos produtos */
    }

    .produto img {
        max-width: 100px;
        max-height: 100px;
        margin-right: 10px;
        border-radius: 5px;
    }

    .button {
        margin: 10px;
        display: inline-block;
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 3px;
    }

    .button:hover {
        background-color: #0056b3;
    }

    .editar {
        margin-right: 10px;
    }

    .excluir {
        background-color: #dc3545;
    }


    .total {
        margin-top: 20px;
        padding: 10px;
        background-color: #fff;
        border-radius: 5px;
        text-align: center;
        display: inline;
    }
</style>


<div class="container">
    <h2>Seu Carrinho</h2>
    <div>
        <?php
        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $produto_carinho) {
                echo '<div class="produto">';
                echo  $produto_carinho['nome'] . "<br>";
                echo "<img src='" . '../' . $produto_carinho['imagem'] . "'> <br>";
                echo  'Quant: ' . $produto_carinho['quantidade'] . "<br>";
                echo  'Preço Unid: ' . $produto_carinho['preco'] . "MT <br>";
                echo  'Total: ' . $produto_carinho['preco'] * $produto_carinho['quantidade'] . "MT<br>";
                echo "<a class='button editar' href='?adicionar=" . $produto_carinho['id'] . "'>+</a>";
                echo "<a class='button excluir' href='?remover=" . $produto_carinho['id'] . "'>-</a>";
                echo '</div>';
            }
        } else {
            echo "<div>Carrinho de compras vazio</div>";
        }
        ?>
    </div>
    <div class="total">
        <h3>Total</h3>
        <?php
        $total = 0; // Inicializa a variável total
        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $produto_carinho) :
                $subtotal = $produto_carinho['preco'] * $produto_carinho['quantidade'];
                $total += $subtotal; // Adiciona o subtotal ao total
            endforeach;
        }
        ?>
        <?php echo $total . 'MT <br>' ?>
    </div>
    <a href="?efectuar_pagamento" class="button">Efectuar Compra</a>
</div>

