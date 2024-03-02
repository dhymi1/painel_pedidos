<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Painel de Pedidos</title>
    <style>
        .list-group-item {
            cursor: pointer;
        }
        .data-details {
            display: none;
        }
        li {
            color: blue;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
       
        <ul class="list-group mt-3" id="listaPedidos">
            <?php
            // Função para carregar os pedidos da tabela
            function loadPedidos() {
                $file = 'pedidos.txt';
                if (file_exists($file)) {
                    $pedidos = file($file);
                    foreach ($pedidos as $index => $pedido) {
                        echo "<li class='list-group-item' data-id='$index' onclick='toggleDetails($index)'>$pedido";
                        echo "<div class='float-center'>";
                        echo "<button class='btn btn-primary btn-sm mr-2 edit-btn' onclick='editPedido($index)'><i class='fas fa-edit'></i> Editar</button>";
                        echo "<button class='btn btn-danger btn-sm delete-btn' onclick='deletePedido($index)'><i class='fas fa-trash'></i> Apagar</button>";
                        echo "</div>";
                        echo "</li>";
                        echo "<div class='data-details' id='details$index' style='display: none;'>";
                        echo "<p>$pedido</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<li class='list-group-item'>Nenhum pedido encontrado.</li>";
                }
            }

            loadPedidos(); // Chamar a função para carregar os pedidos da tabela
            ?>
        </ul>
    </div>

    <!-- Adicionando Bootstrap JS e Popper.js via CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        // Função para atualizar os pedidos da lista a cada 5 segundos
        setInterval(updatePedidos, 5000); // Chamar a função 'updatePedidos' a cada 5000 milissegundos

        function updatePedidos() {
            // Fazer uma solicitação AJAX ao servidor para buscar os pedidos mais recentes do arquivo pedidos.txt
            fetch('painel_pedidos.php') // Substitua 'get_pedidos.php' pelo script que retorna os pedidos do arquivo pedidos.txt
                .then(response => response.text())
                .then(data => {
                    document.getElementById('listaPedidos').innerHTML = data; // Atualizar apenas o conteúdo da lista com os novos pedidos
                })
                .catch(error => console.error('Erro ao atualizar pedidos da lista:', error));
        }

        // Função para exibir/ocultar os detalhes dos dados ao clicar no pedido
        function toggleDetails(index) {
            const details = document.getElementById(`details${index}`);
            if (details.style.display === 'none') {
                details.style.display = 'block';
            } else {
                details.style.display = 'none';
            }
        }

        function editPedido(index) {
            // Redireciona para a página de edição passando o índice do pedido como parâmetro na URL
            window.location.href = "edit_pedido.php?index=" + index;
        }

        function deletePedido(index) {
            if (confirm("Tem certeza que deseja apagar este pedido?")) {
                // Envia o índice do pedido a ser apagado para o arquivo delete_pedido.php via AJAX
                const xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert("Pedido apagado com sucesso!");
                        // Recarrega a página após a exclusão
                        location.reload();
                    }
                };
                xhttp.open("POST", "delete_pedido.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("index=" + index);
            }
        }
    </script>
</body>
</html>
