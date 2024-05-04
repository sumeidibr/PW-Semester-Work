<style>
    .conatainer-perfil {
        width: 100%;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    .conatainer-perfil form {
        max-width: 400px;
        margin: 20px auto;
        background: #fff;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .conatainer-perfil label {
        font-weight: bold;
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
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>



<div class="conatainer-perfil">

    <h2>Atualização de Dados do Cliente</h2>
    <form action="atualizacao_dados.php" method="post" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required value="<?php echo $_SESSION['user']['nome'] ?>">

        <label for="apelido">Apelido:</label>
        <input type="text" id="apelido" name="apelido" value="<?php echo $_SESSION['user']['apelido'] ?>">

        <label for=" senha_atual">Senha Atual:</label>
        <input type="password" id="senha_atual" name="senha_atual" required>

        <label for="nova_senha">Nova Senha:</label>
        <input type="password" id="nova_senha" name="nova_senha" required>

        <label for="confirmar_senha">Confirmar Senha:</label>
        <input type="password" id="confirmar_senha" name="confirmar_senha" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required value="<?php echo $_SESSION['user']['email'] ?>">

        <label for=" imagem">Imagem:</label>
        <input type="file" id="imagem" name="imagem">

        <label for=" telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" pattern="[0-9]{9}" required value="<?php echo $_SESSION['user']['telefone'] ?>">
        
        <input type="submit" value="Atualizar Dados">
    </form>

</div>