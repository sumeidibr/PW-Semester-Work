<?php
include '../../gestor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $id_categoria = $_POST['idcategoria'];
    $nome = $_POST['nome_categoria'];
    $descricao = $_POST['descricao_categoria'];
    $tipo_cliente = $_POST['tipo_cliente'];

    $obj = new Gestor();

    // Prepare os parâmetros para a consulta SQL
    $params = array(
        ':id_categoria' => $id_categoria,
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':tipo_cliente' => $tipo_cliente
    );

    // Consulta SQL para atualização de dados
    $sql = 'UPDATE categoria SET nome = :nome, descricao = :descricao, tipo_cliente = :tipo_cliente WHERE idcategoria = :id_categoria';

    // Executar a consulta SQL
    $obj->EXE_NON_QUERY($sql, $params);

    // Redirecionar para a página inicial após a atualização
    Header('Location: ../index.php');
}
?>
