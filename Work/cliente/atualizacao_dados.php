<?php

if(!isset($_SESSION)){

    session_start();
}
include '../gestor.php';
$gestor = new Gestor();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  
    $imagem_temp = $_FILES["imagem"]["tmp_name"];
    $imagem_nome = $_FILES["imagem"]["name"];
   
    $data_atual = date("Y-m-d_H-i-s");

    // Extrair a extensão do nome da imagem
    $extensao = pathinfo($imagem_nome, PATHINFO_EXTENSION);

    $nome = $_POST['nome'];
    $nome_imagem_com_data = $nome . "_" . $data_atual . "." . $extensao;

    $diretorio_destino = "../uploads/";
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
        ':id' => $_SESSION['user']['id'],
        ':nome' => $_POST['nome'],
        ':apelido' => $_POST['apelido'],
        ':nova_senha' => password_hash($_POST['nova_senha'], PASSWORD_DEFAULT),
        ':telefone' => $_POST['telefone'],
        ':imagem' => $diretorio_banco . $nome_imagem_com_data
    );

    $sql = 'UPDATE user SET primeiro_nome = :nome, apelido = :apelido, icon =:imagem, telefone = :telefone, password = :nova_senha where iduser = :id';
    $gestor->EXE_NON_QUERY($sql,$params);
    echo    'sucesso ao atualizar';
}
