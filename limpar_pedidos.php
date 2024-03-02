<?php
$file = 'pedidos.txt';

// Verifica se o arquivo de pedidos existe
if (file_exists($file)) {
    // Abre o arquivo em modo de escrita
    $handle = fopen($file, 'w');

    // Limpa o conteúdo do arquivo
    fwrite($handle, '');

    // Fecha o arquivo
    fclose($handle);

    // Redireciona de volta para a página anterior (ou para onde você desejar)
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
} else {
    // Se o arquivo não existir, apenas redireciona de volta para a página anterior
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}
?>
