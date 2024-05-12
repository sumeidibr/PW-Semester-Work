<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--Inicio-->
    <link rel="stylesheet" href="inicio.css">

    <link rel="stylesheet" href="seccao_1.css">
    

    
</head>
<body>
<?php
include 'gestor.php';
$obj = new Gestor();

$sql = 'SELECT * FROM produto';
$result = $obj->EXE_QUERY($sql);

?>


<div  class="main">
<!--- Slide animado para seccao 1 (inicio)-->

<section class="containerproject">
    <div class="slide-container active">
        <div class="slide">
            <div class="contentproject">
                <h3>Título </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam natus aliquid autem, ut rem recusandae corrupti consectetur asperiores et. Quidem reprehenderit consectetur unde modi nisi. Harum ratione natus odio doloribus.</p>
                <a href="" class="btnproj">saiba mais</a>
            </div>
        </div>
    </div>

    <div class="slide-container">
        <div class="slide">
            <div class="contentproject">
                <h3>Conteúdo</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam natus aliquid autem, ut rem recusandae corrupti consectetur asperiores et. Quidem reprehenderit consectetur unde modi nisi. Harum ratione natus odio doloribus.</p>
                <a href="" class="btnproj">saiba mais</a>
            </div>
        </div>
    </div>

    <div class="slide-container">
        <div class="slide">
            <div class="contentproject">
                <h3>Objectivo</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam natus aliquid autem, ut rem recusandae corrupti consectetur asperiores et. Quidem reprehenderit consectetur unde modi nisi. Harum ratione natus odio doloribus.</p>
                <a href="img_slide/jackdaw-4415083_1920.jpg" class="btnproj">saiba mais</a>
            </div>
        </div>
    </div>

    <div id="prev" onclick="prev()"> </div>
    <div id="next" onclick="next()"> </div>
</section>



<!--
<section class="seccao_1">
    <div class="div_1">
        <h1 style="font-size: 1.9rem;">A sua Loja Online</h1>
    <p style="text-align: justify;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatum, nulla? Vitae qui, facilis natus, pariatur dolor in fuga doloremque </p>
    <button>Testando</button>
    </div>

    <div class="div_2">
    <p>.
    </p>
    </div>

</section>

--->


 <!---Introducao-->
<section class="conteudo">
      <section class="introducao">
        <div class="divisao-1">
            <h2>Cg_Business</h2>
            <img src="logo-1.png" alt="">
        </div>

       <div class="divisao-2">
            <h2><span>MODERNIZE</span> SEUS PROCESSOS <span>COM</span>  COMPUTADORES PARA <span>EMPRESA</span></h2>
        </div>

    </section>
        <div class="parag"> 
            
            <p>Lorem ipsum dolor  amet consectetur adipisicing elit. Voluptatum possimus, eveniet quas voluptates est quasi aspernatur
                 <div class="botao">
                 <button>Contactar</button>
             </div></p>
        </div>
</section>













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

                    <a href="?p=login" class="botao">Adicionar</a>
                </div>
            <?php } ?>
        <?php endforeach; ?>
    </div>

</div>



<script src="seccao_1.js"></script>
</body>
</html>









