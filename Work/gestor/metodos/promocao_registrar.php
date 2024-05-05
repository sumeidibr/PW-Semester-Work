<?php
include '../../gestor.php';

$obj = new Gestor();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Extract POST data
        $nome = $_POST["nome_promo"];
        $descricao = $_POST["descricao_promo"];
      
      /*  $desconto = $_POST["desconto"];
        $dataInicio = $_POST["dataInicio"];
        $dataFim = $_POST["dataFim"];
        $dataFim = $_POST["dataFim"];
        $status = $_POST["status"];

        var_dump($_POST);*/
    
    }
  
        $params = array(
            ':nome' => $nome,
            ':descricao' => $descricao
        );
        $obj->EXE_NON_QUERY('INSERT INTO promocao VALUES (0, :nome, :descricao)', $params);

        echo 'Promocao cadastrada com sucesso';
        Header('Location: ../index.php');

?>
