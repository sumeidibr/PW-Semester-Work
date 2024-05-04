


<div class="container-carrinho">
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
                echo "<a class='button excluir' href='?deletar_produt=" . $produto_carinho['id'] . "'>DEL</a>";
                echo '</div>';
            }
        } else {
            echo "<div>Carrinho de compras vazio</div>";
        }
        ?>
    </div>
    <div class="total-carrinho">
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


