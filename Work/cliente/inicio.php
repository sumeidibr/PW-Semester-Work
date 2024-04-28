<?php
include '../gestor.php';
$obj = new Gestor();

$sql = 'SELECT * FROM produto';

$result = $obj->EXE_QUERY($sql);
?>

<button id="openModalBtn">Abrir Modal</button>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <!--- header-->
        <header>
            <!---nav-->
            <div class="nav container " id="cart-icon">
                <!--    <i class='bx bx-shopping-bag' id="cart-icon" > Carrinho</i> -->
                <!--- cart-->
                <div class="cart">
                    <h2 class="cart-title">Seu Carrinho</h2>
                    <!---- content-->
                    <div class="cart-content">

                    </div>
                    <!--- total-->
                    <div class="total">
                        <div class="total-title">Total</div>
                        <div class="total-price">0$</div>
                    </div>
                    <!--- buy button-->
                    <button type="button" id="comprarBtn" class="btn-buy">Comprar</button>
                    <!--- cart close-->
                    <i class='bx bx-x' id="close-cart"></i>
                </div>
            </div>
        </header>
    </div>
</div>

<section class="shop container">
    <?php
    foreach ($result as $produto) {
    ?>
        <div class="shop-content">
            <!--- box 1-->
            <div class="product-box" data-id="<?php echo $produto['idproduto']; ?>" data-cliente="Nome_do_Cliente">
                <img src="<?php echo '../'.$produto['imagem']?>" alt="" class="product-img">
                <h2 class="product-title"><?php echo $produto['nome']?></h2>
                <span class="price"><?php echo $produto['preco']?></span>
                <button class='add-cart'>Add to Cart</button>
            </div>
        </div>
    <?php } ?>
</section>

<script>
    document.getElementById("comprarBtn").addEventListener("click", function() {
        // Aqui você pode coletar os dados relevantes do carrinho
        // e enviá-los para o servidor usando uma solicitação AJAX
        var total = document.querySelector(".total-price").textContent;
        var quantidadeProdutos = document.querySelectorAll(".product-box").length;

        // Você precisará coletar os dados relevantes de cada produto no carrinho
        var produtos = [];
        var produtosNoCarrinho = document.querySelectorAll(".product-box");
        produtosNoCarrinho.forEach(function(produto) {
            var idProduto = produto.getAttribute("data-id");
            var nomeCliente = produto.getAttribute("data-cliente");

            // Adicione os dados de cada produto à lista de produtos
            produtos.push({
                idproduto: idProduto,
                nome_cliente: nomeCliente
            });
        });

        var dadosDoCarrinho = {
            total: total,
            quantidade: quantidadeProdutos,
            produtos: produtos
        };

        // Envia uma solicitação POST para o script PHP que processará os dados
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "processar_compra.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Manipule a resposta do servidor, se necessário
                console.log(xhr.responseText);
                // Redirecione para a página de processamento de cadastro após a conclusão
                window.location.href = "processar_compra.php";
            }
        };
        xhr.send(JSON.stringify(dadosDoCarrinho));
    });
</script>

