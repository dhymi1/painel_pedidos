<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Painel de Pedidos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <audio id="notification">
        <source src="notify.mp3" type="audio/mpeg">
        Seu navegador não suporta o elemento de áudio.
    </audio>
</head>
<body>
    <div class="container">
        <ul class="list-group mt-3" id="listaPedidos">
            <?php
            $file = 'pedidos.txt';
            if (file_exists($file)) {
                $pedidos = file($file);
                $pedidos = array_reverse($pedidos); // Inverte a ordem do array
                
                foreach ($pedidos as $index => $pedido) {
                    echo "<li class='list-group-item' data-id='$index' onclick='toggleDetails($index)'>$pedido";
                    echo "<div class='float-right'>";
                    echo "<button class='btn btn-danger btn-sm delete-btn' onclick='deletePedido($index)'><i class='fas fa-trash'></i> Apagar</button>";
                    echo "</div>";
                    echo "</li>";
                    echo "<div class='data-details' id='details$index' style='display: none;'>";
                    echo "<p>$pedido</p>";
                    echo "</div>";
                }
                echo "<script>document.getElementById('notification').play();</script>"; // Reproduz o som
            } else {
                echo "<li class='list-group-item'>Nenhum pedido encontrado.</li>";
            }
            ?>
        </ul>
    </div>

    <!-- Adicionando Bootstrap JS e Popper.js via CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
