<?php
include '../gestor.php';
$obj = new Gestor();
if (!empty($_POST)) {

    $pesq = '%' . $_POST['pesquisa'] . '%';

    $pesquisa = array(
        ':pesq' => $pesq
    );

    $sql = 'SELECT * FROM produto WHERE nome LIKE :pesq';

    $resultadosPesquisados = $obj->EXE_QUERY($sql, $pesquisa);
}
?>

<h2 style="text-align: center; margin-top: 20px; color:#ff5722 ;"><span style="color: #602f20; border-bottom: 1px solid #602f20; border-width: 4px;">Produtos</span> Pesquisados</h2>

<div class="Loja">
    
    <?php if (!empty($resultadosPesquisados)) : ?>
        
        <div class="container_catalogo">
            <?php foreach ($resultadosPesquisados as $produto) : ?>
                <?php if ($produto['estoque'] >= 1) { ?>
                    <div class="card">
                        <img src="<?php echo '../' . $produto['imagem'] ?>" alt="imagem_produto">
                        <div class="info">
                            <p class="nome"><?php echo $produto['nome'] ?></p>
                            <?php
                            $hoje = date('Y-m-d');
                            $sql_promocao = 'SELECT * FROM produto_has_promocao WHERE idProduto = :id_produto AND :hoje BETWEEN Data_Inicio AND Data_Fim';
                            $params_promocao = array(':id_produto' => $produto['idproduto'], ':hoje' => $hoje);
                            $resultado_promocao = $obj->EXE_QUERY($sql_promocao, $params_promocao);
                            echo  '<p class="preco">' . $produto['preco'] . ' Mzn</p>';
                            if ($resultado_promocao) {
                                echo 'PROMOCAO: <br>';
                                echo 'Desconto: ' . $resultado_promocao[0]['desconto'] . '% <hr>';
                                echo '<p class="preco"> Desconto: ' . ($produto['preco'] - ($produto['preco'] * ($resultado_promocao[0]['desconto'] / 100))) . ' MT</p>';
                            } else {
                                echo 'O produto não está em promoção';
                            }
                            ?>
                        </div>
                        <a href="?add_carrinho=<?php echo $produto['idproduto'] ?>" class="botao">Adicionar</a>
                    </div>
                <?php } ?>
            <?php endforeach; ?>
        </div>

<<<<<<< HEAD
<?php
$sql = 'SELECT * FROM produto';
$resultados = $obj->EXE_QUERY($sql);
=======
    <?php else : ?>
>>>>>>> main

    
        
            <?php
        $sql = 'SELECT * FROM produto';
        $resultados = $obj->EXE_QUERY($sql);
        
        $sql = 'SELECT * FROM categoria';
        $resultadoscategorias = $obj->EXE_QUERY($sql);
        ?>
        <div class="categorias">
            <h2>Categorias  +</h2>
            <?php foreach ($resultadoscategorias as $categoria) : ?>
                <a href="?p=produto&produto=<?php echo $categoria['idcategoria'] ?>" ><?php echo $categoria['nome'] ?></a>
            <?php endforeach; ?>
        </div>
        
        <?php
        foreach ($resultados as $produto) {
            if (isset($_GET['produto']) && filter_var($_GET['produto'], FILTER_VALIDATE_INT) !== false) {
                if ($produto['categoria'] == (int)$_GET['produto'] && $produto['estoque'] >= 1) {
                    ?>
                    <div class="card">
                        <img src="<?php echo '../' . $produto['imagem'] ?>" alt="imagem_produto">
                        <div class="info">
                            <p class="nome"><?php echo $produto['nome'] ?></p>
                            <?php
                            $hoje = date('Y-m-d');
                            $sql_promocao = 'SELECT * FROM produto_has_promocao WHERE idProduto = :id_produto AND :hoje BETWEEN Data_Inicio AND Data_Fim';
                            $params_promocao = array(':id_produto' => $produto['idproduto'], ':hoje' => $hoje);
                            $resultado_promocao = $obj->EXE_QUERY($sql_promocao, $params_promocao);
                            echo '<p class="preco">Preço Normal: ' . $produto['preco'] . ' Mzn</p>';
                            if ($resultado_promocao) {
                                echo 'PROMOCAO: <br>';
                                echo 'Desconto: ' . $resultado_promocao[0]['desconto'] . '% <hr>';
                                echo '<p class="preco">Preço Com Desconto: ' . ($produto['preco'] - ($produto['preco'] * ($resultado_promocao[0]['desconto'] / 100))) . ' MT</p>';
                            } else {
                                echo 'O produto não está em promoção';
                            }
                            ?>
                        </div>
                        <a href="?add_carrinho=<?php echo $produto['idproduto'] ?>" class="botao">Adicionar</a>
                    </div>
                    <?php
                }
            }
        }
        ?>
        
        
        <?php endif; ?>
  
</div>