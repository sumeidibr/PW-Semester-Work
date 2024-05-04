<?php
include 'gestor.php';
session_start();
$obj = new Gestor();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $obj = new Gestor();
    $apelido = $_POST["apelido"];
    $pnome = $_POST["pnome"];
    $email = $_POST["email"];
    $tipo_user = $_POST["tipo_user"];
    $senha = $_POST["senha"];
    $telefone = $_POST["telefone"];

    $imagem_temp = $_FILES["imagem"]["tmp_name"];
    $imagem_nome = $_FILES["imagem"]["name"];
   
    $data_atual = date("Y-m-d_H-i-s");
        // Extrair a extensão do nome da imagem
        $extensao = pathinfo($imagem_nome, PATHINFO_EXTENSION);

        $nome = $_POST['pnome'];
        $nome_imagem_com_data = $nome . "_" . $data_atual . "." . $extensao;
    
        $diretorio_destino = "uploads/";
        $diretorio_banco = "uploads/";
        if (!file_exists($diretorio_destino)) {
            mkdir($diretorio_destino, 0777, true);
        }
        if (move_uploaded_file($imagem_temp, $diretorio_destino . $nome_imagem_com_data)) {
            echo "A imagem foi copiada com sucesso para o diretório de destino.";
        } else {
            echo "Erro ao copiar a imagem para o diretório de destino.";
        }
    $params = array(
        ':primeiro_nome' => $pnome,
        ':apelido' => $apelido,
        ':email' => $email,
        ':senha' => password_hash($senha, PASSWORD_DEFAULT),
        ':tipo_user' => $tipo_user,
        ':icon' =>  $diretorio_banco . $nome_imagem_com_data,
        ':telefone' => $telefone
    );
    $sql = 'INSERT INTO user VALUES (0, :primeiro_nome, :apelido, :email, :senha, :tipo_user, :icon,:telefone)';
    $obj->EXE_NON_QUERY($sql, $params);

    echo 'sucess';

    header("Location: index.php");
} else {
    echo "nada";
}

