<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuário</title>
</head>
<body>
    <h2>Registro de Usuário</h2>
    <form action="processar_registro.php" method="post">
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="txt_usuario" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="txt_senha" required>
        <br>
        <input type="submit" value="Registrar">
    </form>
</body>
</html>
