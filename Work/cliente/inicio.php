<style>
    .carrinho-container {
        display: flex;
        flex-wrap: wrap;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .produto {
        width: 25.5%;
        padding: 0 30px;
    }

    .produto img {
        max-width: 30%;
    }

    .produto a {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #5fb382;
        text-align: center;
        text-decoration: none;
    }

    h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }

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
</style>

<?php
include '../gestor.php';
$obj = new Gestor();

$sql = 'SELECT * FROM produto';
$result = $obj->EXE_QUERY($sql);

// Promocao
$sql = 'SELECT * FROM promocao';
$result_promocao = $obj->EXE_QUERY($sql);
?>

<div class="carrinho-container">
    <?php foreach ($result as $produto) : ?>
        <div class="produto">
            <img src="<?php echo '../' . $produto['imagem'] ?>" alt="" class="product-img">
            <p><?php echo $produto['nome'] ?></p>
            <p>Quantidade: <?php echo $produto['estoque'] ?> </p>
            <?php
            $count = 0;
            foreach ($result_promocao as $prom) {
                if ($produto['idproduto'] == $prom['id_produto']) {
                    $promocao = 1.0 + ($prom['desconto'] / 100);
                    $count++;
                }
            }
            $preco = $count > 0 ? $produto['preco'] * $promocao : $produto['preco'];
            ?>
            <p>Preço: <?php echo number_format($preco, 2) ?> MT</p>
            <a href="?adicionar=<?php echo $produto['idproduto'] ?>">Adicionar ao carrinho</a>
            <a href="?remover=<?php echo $produto['idproduto'] ?>">Remover ao carrinho</a>
        </div>
    <?php endforeach; ?>
</div>

<?php
// Verificando se existe a chave 'adicionar' no array $_GET e se é um número inteiro positivo
if (isset($_GET['adicionar']) && filter_var($_GET['adicionar'], FILTER_VALIDATE_INT) !== false && $_GET['adicionar'] >= 0) {
    $idpro = (int)$_GET['adicionar'];
    // Verificando se o produto com o id 'adicionar' existe no array $result
    $produto_encontrado = false;
    foreach ($result as $produto) {
        if ($produto['idproduto'] == $idpro) {
            $produto_encontrado = true;
            break;
        }
    }
    if ($produto_encontrado) {
        if (isset($_SESSION['carrinho'][$idpro])) {
            $_SESSION['carrinho'][$idpro]['quantidade']++;
        } else {
            $_SESSION['carrinho'][$idpro] = [
                'id' => $idpro,
                'nome' => $produto['nome'],
                'preco' => $produto['preco'],
                'imagem' => $produto['imagem'],
                'quantidade' => 1
            ];
        }
        echo '<script> alert("O item foi adicionado ao carinho"); </script>';
    } else {
        die('Parametro invalido');
    }
}
?>

<?php
// Verificando se existe a chave 'remover' no array $_GET e se é um número inteiro positivo
if (isset($_GET['remover']) && filter_var($_GET['remover'], FILTER_VALIDATE_INT) !== false && $_GET['remover'] >= 0) {
    $idpro = (int)$_GET['remover'];
    // Verificando se o produto com o id 'remover' existe no array $result
    $produto_encontrado = false;
    foreach ($result as $produto) {
        if ($produto['idproduto'] == $idpro) {
            $produto_encontrado = true;
            break;
        }
    }
    if ($produto_encontrado) {
        if (isset($_SESSION['carrinho'][$idpro])) {
            if ($_SESSION['carrinho'][$idpro]['quantidade'] > 1) {
                $_SESSION['carrinho'][$idpro]['quantidade']--;
            } else {
                unset($_SESSION['carrinho'][$idpro]); // Remove completamente o item do carrinho se a quantidade for 1
            }
        } else {
            echo '<script> alert("Impossivel reduzir sem antes ter"); </script>';
        }
        echo '<script> alert("O item foi removido do carrinho"); </script>';
    } else {
        die('Parametro invalido');
    }
}
?>



<h2>Carrinho</h2>
<div class="carinho_compras">
    <?php foreach ($_SESSION['carrinho'] as $produto_carinho) : ?>
        <div class="cart-item">
            <div class="cart-item-details">
                <img src="../<?php echo $produto_carinho['imagem']; ?>" alt="Imagem do Produto">
                <div class="product-info">
                    <h3><?php echo $produto_carinho['nome']; ?></h3>
                    <p>Quantidade: <?php echo $produto_carinho['quantidade']; ?></p>
                    <p>Preço Unitário: $<?php echo $produto_carinho['preco']; ?></p>
                    <p>Preço Total: $<?php echo $produto_carinho['preco'] * $produto_carinho['quantidade']; ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="cart-buttons">
        <button onclick="efetuarCompra()">Efectuar Compra</button>
        <button onclick="limparCarrinho()">Limpar Carrinho</button>
        <button onclick="simularPagamento()">Simular Pagamento</button>
    </div>
</div>

<script>
    function efetuarCompra() {
        // Lógica para efetuar a compra
        alert('Compra efectuada com sucesso!');
    }
    function limparCarrinho() {
        // Lógica para limpar o carrinho
        alert("Carrinho limpo com sucesso");
    } 

    function simularPagamento() {
        let total = 0;
        <?php foreach ($_SESSION['carrinho'] as $produto_carinho) : ?>
            total += <?php echo $produto_carinho['preco'] * $produto_carinho['quantidade']; ?>;
        <?php endforeach; ?>
        alert("Total a pagar: $" + total.toFixed(2));
    }
</script>
