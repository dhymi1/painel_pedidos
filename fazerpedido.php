<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Pedidos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    
    <form id="cadastroForm" style="max-width: 420px; height: auto; margin: 10px;">   
        <label for="pedido"><b>Pedido:</b></label>
        <input type="text" id="pedido" name="pedido" placeholder="Digite seu pedido" required>
        <input type="hidden" id="hora_pedido" name="hora_pedido"> <!-- Campo oculto para armazenar a hora do pedido -->
        <button type="button" class="whatsapp-button" onclick="sendPedido()">Enviar Pedido</button>
    </form>

    <a href="painel_pedidos.php" class="btn btn-black-orange fixed-bottom-right mt-3">Painel de Pedidos</a>

    <!-- Botão Apagar Pedidos -->
    <button type="button" class="btn btn-danger apagar-pedidos-btn" onclick="apagarPedidos()">Apagar Pedidos</button>

    <!-- Script para enviar o pedido e apagar os pedidos -->
    <script>
        function sendPedido() {
            const pedido = document.getElementById('pedido').value.trim();
            const horaPedido = new Date().toLocaleTimeString(); // Obtém a hora atual

            if (!pedido) {
                alert("Por favor, digite seu pedido!");
                return;
            }

            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert("Pedido enviado com sucesso!");
                    document.getElementById('pedido').value = ''; // Limpa o campo de pedido após o envio
                }
            };
            xhttp.open("POST", "save_pedido.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("pedido=" + encodeURIComponent(pedido + " - " + horaPedido)); // Envie o pedido com a hora para o servidor PHP
        }

        function apagarPedidos() {
            const senha = prompt("Por favor, digite a senha para confirmar a exclusão de todos os pedidos:");
            
            // Se a senha for correta (1234), envia a solicitação para limpar os pedidos
            if (senha === '1234') {
                // Requisição AJAX para chamar o arquivo PHP que limpa os pedidos
                const xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert("Todos os pedidos foram apagados com sucesso!");
                        // Recarrega a página após limpar os pedidos
                        location.reload();
                    }
                };
                xhttp.open("POST", "limpar_pedidos.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(); // Envie a solicitação para limpar os pedidos
            } else {
                alert("Senha incorreta. A exclusão de todos os pedidos foi cancelada.");
            }
        }
    </script>
</body>
</html>
