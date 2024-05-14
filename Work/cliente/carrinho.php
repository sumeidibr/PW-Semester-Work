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
    <a href="#" class="button" id="openModal">Processar compra</a>
</div>
<?php
function generateReference()
{
    $prefix = "TobSales";
    $length = 8;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    // Gera caracteres aleatórios até atingir o comprimento desejado
    while (strlen($randomString) < $length) {
        $randomCharacter = $characters[rand(0, $charactersLength - 1)];
        // Garante que o caractere gerado não se repita na string
        if (strpos($randomString, $randomCharacter) === false) {
            $randomString .= $randomCharacter;
        }
    }

    return $prefix . $randomString;
} ?>

<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="container-pagamento">
            <h2>Formulário Pagamento</h2>
            <form action="?efectuar_pagamento" method="post" onsubmit="return validateReference()">
                <div class="form-group">
                    <label for="celular">Número de Celular Vodacom Only:</label>
                    <input type="text" id="celular" name="celular" placeholder="Ex:. 842156451" required >
                </div>
                <div class="form-group">
                    <label for="valor">Valor:</label>
                    <input type="number" id="valor" name="valor" placeholder="Digite o valor" required value="<?php echo $total ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="referencia">Referência:</label>
                    <?php if ($total == 0) : ?>
                        <input type="text" id="referencia" name="referencia" placeholder="Digite a referência" required readonly>
                    <?php else : ?>
                        <input type="text" id="referencia" name="referencia" placeholder="Digite a referência" value="<?php echo generateReference(); ?>">
                    <?php endif; ?>
                </div>
                <input type="submit" value="Enviar">
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var confirmar = document.getElementById('confirmar');
        if (!confirmar.checked) {
            alert("Por favor, confirme a compra antes de efetuar o pagamento.");
            return false;
        }
        return true;
    }

    function validateReference() {
        var referencia = document.getElementById('referencia').value;
        if (referencia === "") {
            alert("Adicione Produtos ao carrinho troll :-)");
            return false;
        }
        return true;
    }
</script>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("openModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>