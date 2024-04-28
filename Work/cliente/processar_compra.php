<?php
// Verifica se a solicitação POST foi recebida
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recupera os dados enviados através da solicitação POST
    $dadosDoCarrinho = json_decode(file_get_contents("php://input"), true);

    // Verifica se os dados foram recebidos corretamente
    if ($dadosDoCarrinho) {
        // Aqui você pode acessar os dados do carrinho
        $total = $dadosDoCarrinho['total'];
        $quantidade = $dadosDoCarrinho['quantidade'];
        $produtos = $dadosDoCarrinho['produtos'];

        // Agora você pode processar os dados como desejar
        // Por exemplo, salvar os detalhes da compra no banco de dados
        
        // Após processar os dados, você pode enviar uma resposta de volta para o cliente
        echo "Compra processada com sucesso!";
    } else {
        // Se os dados não foram recebidos corretamente, envie uma mensagem de erro
        http_response_code(400);
        echo "Erro: Dados do carrinho não recebidos.";
    }
} else {
    // Se a solicitação não for do tipo POST, envie uma mensagem de erro
    http_response_code(405);
    echo "Erro: Método não permitido. Esta página aceita apenas solicitações POST.";
}
?>
