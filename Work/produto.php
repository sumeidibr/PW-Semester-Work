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
    
 <!--- icons -->
 
     <!--- icons -->
     <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
include 'gestor.php';
$obj = new Gestor();

$sql = 'SELECT * FROM produto';
$result = $obj->EXE_QUERY($sql);

?>

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
      <div class="footer-box">
          <h3>Sucursall</h3>
          <p>Maputo cifdade</p>
          <p>Matola</p>
          <p>Boane</p>
          <p>Xai-xai</p>
      </div>

     
</section>
<!--- COpyright-->

<div class="copyright">
  <p style="color: #fff; font-weight: bold;"><strong style="color: #fb6547;">&#169; Tob_Sales</strong> 2024 Todos os direitos reservados</p>
</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>                                                       
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="seccao_1.js"></script>
<script src="marcas.js"></script>
</body>
</html>









