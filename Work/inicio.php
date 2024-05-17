<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--Inicio-->
    <link rel="stylesheet" href="inicio.css">

    <link rel="stylesheet" href="seccao_1.css">

    <link rel="stylesheet" href="marcas.css">

    <link rel="stylesheet" href="featured.css">
    

    
</head>
<body>
<?php
include 'gestor.php';
$obj = new Gestor();

$sql = 'SELECT * FROM produto WHERE estoque >= 1 ORDER BY RAND() LIMIT 4';
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
                <a href="background_1.avif" class="btnproj">saiba mais</a>
            </div>
        </div>
    </div>

    <div class="slide-container">
        <div class="slide">
            <div class="contentproject">
                <h3>Conteúdo</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam natus aliquid autem, ut rem recusanssdae corrupti consectetur asperiores et. Quidem reprehenderit consectetur unde modi nisi. Harum ratione natus odio doloribus.</p>
                <a href="background_1.avif" class="btnproj">saiba mais</a>
            </div>
        </div>
    </div>

    <div class="slide-container">
        <div class="slide">
            <div class="contentproject">
                <h3>Objectivo</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam natus aliquid autem, ut rem recusandae corrupti consectetur asperiores et. Quidem reprehenderit consectetur unde modi nisi. Harum ratione natus odio doloribus.</p>
                <a href="" class="btnproj">saiba mais</a>
            </div>
        </div>
    </div>

    <div id="prev" onclick="prev()"> </div>
    <div id="next" onclick="next()"> </div>
</section>




<div class="marcas">
    <a><img src="uploads/gucci.png" alt=""></a>
    <a><img src="uploads/adidas" alt=""></a>
    <a><img src="uploads/Dior.png" alt=""></a>
    <a><img src="uploads/puma.png" alt=""></a>
    <a><img src="uploads/vans.png" alt=""></a>
</div>




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

      <section class="introducao">
    <!-- <div class="divisao-1">
            <h2>Tob_Sales</h2>
            <img src="logo-1.png" alt="">
        </div> --->

      <!-- <div class="divisao-2">
            <h2 ><span style="color: #1c0802;">Explorando o mundo da moda. <span></span> </span>Seu visual, sua historia, comece <span  style="color: #1c0802;"> a escrever com </span> <span>nossas roupas.</span></h2>
        </div> -->

    </section>
        


<div class="parag"> 
            
            <p>Na Tob_Sales, abra as portas para um mundo de moda sem limites. Com uma seleção incomparável de roupas que refletem as últimas tendências e um compromisso inabalável com a qualidade, estamos aqui para ajudá-lo a expressar sua individualidade em cada peça que você veste. 
                 <div class="botaoo">
                 <button class="contact_btn">Contactar</button>
             </div></p>
        </div>










<h2 style="text-align: center; margin-top: 20px; color:#ff5722 ;"><span style="color: #602f20; border-bottom: 1px solid #602f20; border-width: 4px;">Mais</span> Populares</h2>
    <div class="container_catalogo">
    
        <?php foreach ($result as $produto) : ?>
            <?php if ($produto['estoque'] >= 1) { ?>
                <div class="card">
                    <img src="<?php echo $produto['imagem'] ?>" alt="imagem_produto">
                    <div class="info">
                        <p class="nome"><?php echo $produto['nome'] ?></p>
                        <?php

                        $hoje = date('Y-m-d');

                        $sql_promocao = 'SELECT * FROM produto_has_promocao WHERE idProduto = :id_produto AND :hoje BETWEEN Data_Inicio AND Data_Fim';
                        $params_promocao = array(':id_produto' => $produto['idproduto'], ':hoje' => $hoje);

                        $resultado_promocao = $obj->EXE_QUERY($sql_promocao, $params_promocao);
                        echo  '<p class="preco">' . $produto['preco'] . ' Mzn</p>';

                        if ($resultado_promocao) {
                            // var_dump($resultado_promocao);
                            //die();
                           // echo 'Promoção: <br>';
                           echo '<p class="preco">Desconto: ' . ($produto['preco'] - ($produto['preco'] * ($resultado_promocao[0]['desconto'] / 100))) . ' Mzn</p>';

                            echo 'Promoção: ' . $resultado_promocao[0]['desconto'] . '% <hr>';
                           
                            // O produto está em promoção
                        } else {
                            //echo 'nopnop';
                            // O produto não está em promoção
                        }
                        ?>
                    </div>

                    <a href="?p=login" class="botao">+</a>
                </div>
            <?php } ?>
        <?php endforeach; ?>
    </div>


    <!------- featured-->
    <section class="featured container" id="featured">
        <!-- heading
        <div class="heading">
            <h2>Featured <span>Items</span></h2>
        </div>
       --->
        <div class="featured-container container">
                 <!---box 1-->
            <div class="box">
                <img src="uploads/product1.png" alt="">
                <div class="text">
                    <h2>Nova coleção<br> de camisetas</h2>
                    <a href="">Nao perca!</a>
                </div>
            </div>
             <!---box 2-->
             <div class="box">
                <div class="text">
                    <h2>20% de desconto<br> no boné</h2>
                    <a href="">Em breve!</a>
                </div>
                <img src="uploads/product6.png" alt="">
            </div>

        </div>
    </section>

<!---Marcas-->
 <section class="client-area">
    <div class="contentor">
        
        <h2> <span>Marcas</span>
            <p style="text-align: center; color: rgb(125, 82, 3);">__________</p>
        </h2>
       
        <section class="logo-area slider">
            <div class="slide"><img src="kjkjkjk.png" alt=""></div>
            <div class="slide"><img src="uploads/vans.png" alt=""></div>
            <div class="slide"><img src="uploads/puma.png" alt=""></div>
            <div class="slide"><img src="uploads/Dior.png" alt=""></div>
            <div class="slide"><img src="uploads/adidas.png" alt=""></div>
            <div class="slide"><img src="uploads/gucci.png" alt=""></div>  
            <div class="slide"><img src="uploads/vans.png" alt=""></div>
            <div class="slide"><img src="uploads/puma.png" alt=""></div>
            <div class="slide"><img src="uploads/Dior.png" alt=""></div>
            <div class="slide"><img src="uploads/adidas.png" alt=""></div>
            <div class="slide"><img src="uploads/gucci.png" alt=""></div>  
        </section>
    </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>                                                       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
</section>

<section class="footer">
  
  <div class="footer-box">
      <a href="" class="logo">
          <h1>Tob_Sales<sup style="font-size: 0.5rem; ">TM</sup> </h1>
      </a>
      <div class="social">
          <div class="media">
              <a href=""><i class='bx bxl-facebook' ></i></a>
              <a href=""><i class='bx bxl-instagram' ></i></a>
              <a href=""><i class='bx bxl-whatsapp' ></i></a>
          </div>

         <p style="text-align: left; text-decoration: underline; font-size: 1.1rem;"><b>Inscreva-se Newsletter</b></p>
         <p style="width: 330px; font-size: 0.8rem;">Ao se inscrever você concorda com os termos de uso e politica de privacidade.</p>
          <div class="newsletter">
              <form action="">
                  <input type="email" name="" id="" placeholder="Enter your email..." class="email-box" required>
                  <input type="submit" value="Subscribe" class="btn">
              </form> 
          </div>

        <div class="contacts">
          <h3>Contactos</h3>
          <p><b>Email</b>: suporte@tob_sales.co.mz</p> <br>
          <p><b>Contacto do suporte</b>: +258 821234567</p>
          <p>Seg-Sex: 7:00H - 21:00H</p>
          <p>Sab-Dom: 8:15H - 20:00H</p>
        </div> 
      </div>
  </div>
  <div class="footer-box">
      <h3>Pages</h3>
      <a href="#home">Pagina inicial</a>
      <a href="#featured">Destaques</a>
      <a href="#shop">Sobre</a>
      <a href="#new">Categoria</a>
      <a href="#home">Login</a>
      </div>
  <div class="footer-box">
      <h3>Legal</h3>
      <a href="#">Politica de privacidade</a>
      <a href="#">Politica de Refundo</a>
      <a href="#">Termos de uso</a>
      <a href="#">Reclamações</a>
  </div>
     

     
</section>
<!--- COpyright

<div class="copyright">
  <p style="color: #fff; font-weight: bold;"><strong style="color: #fb6547;">&#169; Tob_Sales</strong> 2024 Todos os direitos reservados</p>
</div> --->
</div>



<script src="seccao_1.js"></script>
<script src="marcas.js"></script>
</body>
</html>









