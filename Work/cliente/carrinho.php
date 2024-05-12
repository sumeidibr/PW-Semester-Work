
<style>
.modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 5px;
        }
    </style>

    <div class="container-carrinho">
        <!-- Seu HTML existente -->
        <!-- div com classe container-carrinho -->

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
    <a href="?efectuar_pagamento" class="button">Processar compra</a>

        <a href="#" id="abrirModal" class="button">Processar compra</a>
    </div>

    <div id="modalPagamento" class="modal">
        <div class="modal-content">
            <span class="fechar">&times;</span>
            <!-- Conteúdo da modal -->
            <div class="container-pagamento">
                <h2>Formulário</h2>
                <form action="./payment.php" method="post">
                    <!-- Seu formulário de pagamento -->
                </form>
            </div>
        </div>
    </div>

    <script>
        // Obtém a referência do elemento do botão "Processar Compra"
        var btnAbrirModal = document.getElementById("abrirModal");

        // Obtém a referência do elemento da modal de pagamento
        var modalPagamento = document.getElementById("modalPagamento");

        // Quando o botão for clicado, mostra a modal
        btnAbrirModal.onclick = function () {
            modalPagamento.style.display = "block";
        }

        // Obtém a referência do elemento que fecha a modal
        var spanFechar = document.getElementsByClassName("fechar")[0];

        // Quando o usuário clica no "x", fecha a modal
        spanFechar.onclick = function () {
            modalPagamento.style.display = "none";
        }

        // Quando o usuário clica fora da modal, fecha a modal
        window.onclick = function (event) {
            if (event.target == modalPagamento) {
                modalPagamento.style.display = "none";
            }
        }
    </script>




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
    <a href="?efectuar_pagamento" class="button">Processar compra</a>
</div>

<div class="container-pagamento">
  <h2>Formulário</h2>
  <form action="./payment.php" method="post">
    <div class="form-group">
      <label for="celular">Número de Celular:</label>
      <input type="text" id="celular" name="celular" placeholder="Digite seu número de celular" required>
    </div>
    <div class="form-group">
      <label for="valor">Valor:</label>
      <input type="number" id="valor" name="valor" placeholder="Digite o valor" required>
    </div>
    <div class="form-group">
      <label for="referencia">Referência:</label>
      <input type="text" id="referencia" name="referencia" placeholder="Digite a referência">
    </div>
    <input type="submit" value="Enviar">
  </form>
</div>


