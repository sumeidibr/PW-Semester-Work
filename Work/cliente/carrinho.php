<style>

.cart-item {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 20px;
    }

    .cart-item img {
        width: 100px;
        border-radius: 8px;
        margin-right: 20px;
    }

    .cart-item-details {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .product-info {
        flex: 1;
    }

    .product-info h3 {
        margin: 0;
        font-size: 18px;
    }

    .product-info p {
        margin: 5px 0;
        font-size: 16px;
    }

    .product-total {
        font-size: 18px;
        font-weight: bold;
    }

    .cart-buttons {
        margin-top: 20px;
    }

    .cart-buttons button {
        padding: 10px 20px;
        margin-right: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .cart-buttons button:hover {
        background-color: #0056b3;
    }

    .editar {
        background-color: orange !important;
    }

    .ver {
        background-color: #06f !important;
    }

    .excluir {
        background-color: red !important;
    }

    .button {
        width: 100%;
        height: 50px;
        background: #06f;
        color: white;
        font-weight: bold;
        padding: 5px;
        border-radius: 10px;
        margin: 6px;
        text-decoration: none;

        /*________Modal______*/
        .modal {
            display: none;
            /* Oculta a modal por padrão */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Fundo escuro semi-transparente */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }


    }

</style>

<button id="openModalBtn" style="display: none;">Abrir Modal</button>

<div id="myModal" class="modal" style="display: block;">
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
                        <?php
                        // Verifica se a sessão carrinho existe e não está vazia

                        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
                            foreach ($_SESSION['carrinho'] as $produto_carinho) {
                                echo "<div style='margin: 5px;'>";
                                echo  $produto_carinho['nome'] . "<br>";
                                echo "<img src='" . '../' . $produto_carinho['imagem'] . "'> <br>";
                                echo  $produto_carinho['quantidade'] . "<br>";
                                echo  $produto_carinho['preco'] . "<br>";
                                echo  $produto_carinho['preco'] * $produto_carinho['quantidade'] . "<br>";
                                echo "<a class='button editar' href='?adicionar=" . $produto_carinho['id'] . "'>+</a>";
                                echo "<a class='button excluir' href='?remover=" . $produto_carinho['id'] . "'>-</a>";
                                echo "</div>";
                            }
                        } else {
                            echo "<div>Carrinho de compras vazio</div>";
                        }
                        ?>
                    </div>
                    <!--- total-->
                    <div class="total">
                        <div class="total-title">Total</div>
                        <?php
                        $total = 0; // Inicializa a variável total
                        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
                            foreach ($_SESSION['carrinho'] as $produto_carinho) :
                                $subtotal = $produto_carinho['preco'] * $produto_carinho['quantidade'];
                                $total += $subtotal; // Adiciona o subtotal ao total
                            endforeach;
                        }
                        ?>
                        <div class="total-price"><?php echo $total ?>$</div>
                    </div>

                    <!--- buy button-->
                    <button type="button" class="btn-buy" onclick="simularPagamento()">Comprar</button>
                    <a class="button editar" href="?efectuar_pagamento">Efecturar_Compra</a>
                    <!--- cart close-->
                    <i class='bx bx-x' id="close-cart"></i>
                </div>
            </div>
        </header>
    </div>
</div>

<script>
    var openModalBtn = document.getElementById('openModalBtn');
    var modal = document.getElementById('myModal');
    var closeBtn = document.getElementsByClassName('close')[0];
    var cadastroForm = document.getElementById('cadastroForm');

    openModalBtn.addEventListener('click', function() {
        modal.style.display = 'block';
    });

    closeBtn.addEventListener('click', function(event) {
        modal.style.display = 'none';
        event.stopPropagation(); // Impede a propagação do evento para os elementos pai
    });

    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });

    cadastroForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita o envio padrão do formulário
        // Aqui você pode adicionar o código para lidar com o envio do formulário, como enviar os dados para um servidor ou salvar localmente
        alert('Cliente cadastrado com sucesso!');
        modal.style.display = 'none';
    });
</script>