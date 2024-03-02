
        // Função para atualizar os pedidos da lista a cada 5 segundos
        setInterval(updatePedidos, 3000); // Chamar a função 'updatePedidos' a cada 5000 milissegundos

        function updatePedidos() {
            // Fazer uma solicitação AJAX ao servidor para buscar os pedidos mais recentes do arquivo pedidos.txt
            fetch('painel_pedidos.php') // Substitua 'get_pedidos.php' pelo script que retorna os pedidos do arquivo pedidos.txt
                .then(response => response.text())
                .then(data => {
                    // Limpar a lista de pedidos antes de atualizá-la com os novos pedidos
                    document.getElementById('listaPedidos').innerHTML = "";
                    document.getElementById('listaPedidos').innerHTML = data; // Atualizar apenas o conteúdo da lista com os novos pedidos
                })
                .catch(error => console.error('Erro ao atualizar pedidos da lista:', error));
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
       //                 alert("Pedido apagado com sucesso!");
                        // Recarrega a página após a exclusão
                        location.reload();
                    }
                };
                xhttp.open("POST", "delete_pedido.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("index=" + index);
            }
        }
