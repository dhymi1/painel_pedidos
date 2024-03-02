<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["index"]) && isset($_POST["pedido"])) {
    $index = $_POST["index"];
    $pedido = $_POST["pedido"];
    $file = 'pedidos.txt';

    if (file_exists($file)) {
        $pedidos = file($file);
        if ($index >= 0 && $index < count($pedidos)) {
            $pedidos[$index] = $pedido . "\n";
            file_put_contents($file, implode("", $pedidos));
            header("Location: painel_pedidos.php"); // Redireciona de volta para o painel de pedidos
            exit();
        } else {
            echo "Erro: Índice de pedido inválido.";
            exit();
        }
    } else {
        echo "Erro: Arquivo de pedidos não encontrado.";
        exit();
    }
} else {
    echo "Erro: Requisição inválida.";
    exit();
}
?>
