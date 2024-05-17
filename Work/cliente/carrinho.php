<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>

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
        width: 50%;
        border-radius: 5px;

        display: flex;
        align-items: center;
        justify-content: space-evenly;
    }

    .container-pagamento, .container_pagamento .form {
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .mpesa img{
        border-radius: 100px;
        width: 150px;
    }

    .form input{
        margin: 5px;
        border-radius: 10px;
        border-width: 1px;
        height: 25px;
        border-color: #d3d3d3;
        width: 200px;
        background-color: rgb(250, 250, 250);
    }

    .form input[type="submit"]{
        margin: 5px;
        border-radius: 10px;
        border-width: 1px;
        height: 25px;
        border-color: #d3d3d3;
        color: white;
        width: 140px;
        font-size: 1rem;
        font-weight: bold;
        background-color: red;
    }
</style>

</head>
<body class="body_carrinho">
 <main>
        
     <div class="container-carrinho">
     <h2>Carrinho</h2>
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
     <a href="#" class="button" id="openModal">Efectuar Pagamento</a>
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
             <form action="?efectuar_pagamento" method="post" onsubmit="return validateReference()" class="form">
                 <div class="form-group">
                     <label for="celular">Celular:</label>
                     <input type="text" id="celular" name="celular" placeholder="Ex:. 842156451" required >
                 </div>
                 <div class="form-group">
                     <label for="valor">Valor      :</label>
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
                 <input type="submit" value="Pagar">
             </form>
         </div>

         <div class="mpesa">
            <img src="../uploads/mpesa.png" alt="">
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
    </main>
</body>
</html>


