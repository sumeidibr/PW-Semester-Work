<?php
include '../../gestor.php';

$obj = new Gestor();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Extract POST data
        $id_produto = $_POST["id_produto"];
        $descricao = $_POST["descricao"];
        $desconto = $_POST["desconto"];
        $dataInicio = $_POST["dataInicio"];
        $dataFim = $_POST["dataFim"];
        $dataFim = $_POST["dataFim"];
        $status = $_POST["status"];

        var_dump($_POST);
    
    }
  
        $params = array(
            ':descricao' => $descricao,
            ':desconto' => $desconto,
            ':data_inicio' => $dataInicio,
            ':data_fim' => $dataFim,
            ':statuspro' => $status,
            'id_produto' => 12
        );
        $obj->EXE_NON_QUERY('INSERT INTO promocao VALUES (0, :descricao, :desconto, :data_inicio, :data_fim, :statuspro,:id_produto)', $params);

        echo 'Promocao cadastrada com sucesso';
        Header('Location: ../index.php');

?>
