<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>

    <style>
        body{
            background-color: #e0c6c1;
        }

    .conatainer-perfil {
        width: 100%;
    }

    h2 {
        text-align: center;
        color: #e0664d;
    }

    .conatainer-perfil form {
        max-width: 400px;
        margin: 20px auto;
        background: #fff;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        box-shadow: 1px 1px 5px #fdb1a2;
    }

    .conatainer-perfil label {
        color: rgba(145, 100, 92, 0.742);
    font-weight: 600;
        display: block;
        margin-bottom: 10px;
        color: #333;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    input[type="tel"],
    input[type="file"] {
        width: calc(100% - 22px);
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        width: 40%;
    padding: 10px;
    background-color: #dc5e45;
    color: #ffffff;
    border: none;
    font-weight: bold;
    border-radius: 20px;
    cursor: pointer;
    margin: 10px;
    text-align: center;
    margin: auto;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .suporte{
    background-color: #ff5722;
    padding: 10px;
    width: 60px;
    border-radius: 40px;
    position: fixed;
    float: right;
    right: 0;
    bottom: 50px;
    margin-right: 70px;
    animation: flash 10s linear infinite;
    box-shadow: 1px 1px 10px #30150d;
}

@keyframes flash {
    0% {
      opacity: 1;
    }
    50% {
      opacity: 0.2;
    }
    100% {
      opacity: 1;
    }
  }

</style>

  <!--- icons -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
<div class="conatainer-perfil">

<h2>Dados do Cliente</h2>
<form action="atualizacao_dados.php" method="post" enctype="multipart/form-data">
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" required value="<?php echo $_SESSION['user']['nome'] ?>">

    <label for="apelido">Apelido</label>
    <input type="text" id="apelido" name="apelido" value="<?php echo $_SESSION['user']['apelido'] ?>">

    <label for=" senha_atual">Senha Atual</label>
    <input type="password" id="senha_atual" name="senha_atual" required>

    <label for="nova_senha">Nova Senha</label>
    <input type="password" id="nova_senha" name="nova_senha" required>

    <label for="confirmar_senha">Confirmar Senha</label>
    <input type="password" id="confirmar_senha" name="confirmar_senha" required>

    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" required value="<?php echo $_SESSION['user']['email'] ?>">

    <label for=" imagem">Imagem</label>
    <input type="file" id="imagem" name="imagem">

    <label for=" telefone">Telefone</label>
    <input type="tel" id="telefone" name="telefone" pattern="[0-9]{9}" required value="<?php echo $_SESSION['user']['telefone'] ?>">
    
    <input type="submit" value="Atualizar Dados">
</form>



</div>

<!---Suporte-->
<div class="suporte">
<a href="https://wa.me/message/XLUMIGURZ5QZK1"><i class='bx bx-support' style="color: white; margin-left: 5px; font-size: 2rem;"  ></i></a>
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
</body>
</html>











