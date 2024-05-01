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
            <a href="?add_carrinho=<?php echo $produto['idproduto'] ?>">Adicionar ao carrinho</a>
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
    } else {
        die('Parametro invalido');
    }
}
?>
<?php
// Verificando se existe a chave 'adicionar' no array $_GET e se é um número inteiro positivo
if (isset($_GET['add_carrinho']) && filter_var($_GET['add_carrinho'], FILTER_VALIDATE_INT) !== false && $_GET['add_carrinho'] >= 0) {
    $idpro = (int)$_GET['add_carrinho'];
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
            echo '<script> alert("Erro Item ja adicionado ao carrinho"); </script>';
        } else {
            $_SESSION['carrinho'][$idpro] = [
                'id' => $idpro,
                'nome' => $produto['nome'],
                'preco' => $produto['preco'],
                'imagem' => $produto['imagem'],
                'quantidade' => 1
            ];
            echo '<script> alert("O item foi adicionado ao carinho"); </script>';
        }
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
    } else {
        die('Parametro invalido');
    }
}
?>


<?php
if (isset($_GET['efectuar_pagamento']) && isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    $obj->EXE_NON_QUERY('START TRANSACTION');

    try {
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

        
    } catch (Exception $e) {
        // Caso ocorra algum erro, desfaz as alterações e exibe uma mensagem de erro
        echo 'Erro ao processar pagamento: ' . $e->getMessage();
    }
}
?>





<script>
    function simularPagamento() {
        let total = 0;
        <?php foreach ($_SESSION['carrinho'] as $produto_carinho) : ?>
            total += <?php echo $produto_carinho['preco'] * $produto_carinho['quantidade']; ?>;
        <?php endforeach; ?>
        alert("Total a pagar: $" + total.toFixed(2));
    }
</script>

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