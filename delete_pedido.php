<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["index"])) {
    $index = $_POST["index"];
    $file = 'pedidos.txt';

    if (file_exists($file)) {
        $pedidos = file($file);
        if ($index >= 0 && $index < count($pedidos)) {
            unset($pedidos[$index]);
            file_put_contents($file, implode('', $pedidos));
            echo "success";
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
