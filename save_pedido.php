<?php
// Verifica se os dados do pedido foram enviados via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pedido"])) {
    // Obtém o pedido enviado
    $pedido = $_POST["pedido"];

    // Salva o pedido em um arquivo de registros
    $file = 'pedidos.txt';
    file_put_contents($file, $pedido . PHP_EOL, FILE_APPEND | LOCK_EX);

    // Retorna uma resposta para o JavaScript
    echo "Pedido salvo com sucesso!";
} else {
    // Se os dados não foram enviados via método POST ou se o pedido não foi recebido, retorna uma mensagem de erro
    echo "Erro: Pedido não recebido.";
}
?>
