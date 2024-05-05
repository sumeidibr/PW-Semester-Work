<?php
include '../../gestor.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    // Receber dados do formulário
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $estoque = $_POST["estoque"];
    // $categoria = $_POST["categoria"];
    $categoria = 2;
    $imagem_temp = $_FILES["imagem"]["tmp_name"];
    $imagem_nome = $_FILES["imagem"]["name"];

    $data_atual = date("Y-m-d_H-i-s");

    // Extrair a extensão do nome da imagem
    $extensao = pathinfo($imagem_nome, PATHINFO_EXTENSION);

    $nome_imagem_com_data = $nome . "_" . $data_atual . "." . $extensao;

    $diretorio_destino = "../../uploads/";
    $diretorio_banco = "uploads/";


    if (!file_exists($diretorio_destino)) {
        mkdir($diretorio_destino, 0777, true);
    }
    if (move_uploaded_file($imagem_temp, $diretorio_destino . $nome_imagem_com_data)) {
        echo "A imagem foi copiada com sucesso para o diretório de destino.";
    } else {
        echo "Erro ao copiar a imagem para o diretório de destino.";
    }


    $obj = new Gestor();
    $params = array(
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':preco' => $preco,
        ':estoque' => $estoque,
        ':categoria' => $categoria,
        ':imagem' => $diretorio_banco . $nome_imagem_com_data
    );
    $obj->EXE_NON_QUERY('INSERT INTO produto VALUES (0,:nome, :descricao, :preco, :estoque, :categoria,:imagem)', $params);
   
    Header('Location: ../index.php');
}

