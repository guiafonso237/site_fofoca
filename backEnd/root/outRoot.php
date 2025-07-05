<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table, th, td {
        border:1px solid black;
    }
    #estados{
        text-align: center;
    }
</style>
<body>
    <h1>Mensagens Recentes</h1>
    <table id="estados">
        <tr>
            <th>Usuário</th>
            <th>Mensagem</th>
            <th>ID Mensagem</th>
        </tr>
        <?php
        // Inclua sua configuração de banco de dados
        include('../config.php');
       
        // Consulta para buscar as mensagens
        $consulta = "SELECT * FROM mensagens ORDER BY id_men DESC";
        $resultado = mysqli_query($conn, $consulta);


        if (!$resultado) {
            echo "Erro ao executar a consulta: " . mysqli_error($conn);
            exit();
        }


        // Exibe as variáveis do banco de dados
        while($res = mysqli_fetch_array($resultado)){
            echo "<tr>";
            $sql = "SELECT nome_usuario FROM usuario WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $res["id"]);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($nName);
            $stmt->fetch();
            if($res['estatus'] == 1){
                echo "<td>" . $nName . "</td>";
                echo "<td>" . $res["mensagem"] . "</td>";
                echo "<td>" . $res["id_men"] . "</td>";
                echo "<td><button class='excluir' data-id='" . $res["id_men"] . "'>Excluir</button></td>";
                echo "</tr>";
            }
            header("refresh: 2");
        }
        ?>
    </table>


    <!-- JavaScript -->
   
<script>
        // Seleciona todos os botões com a classe "excluir"
        var botoes = document.querySelectorAll('.excluir');


        // Adiciona o evento de clique para cada botão
        botoes.forEach(function(botao) {
            botao.addEventListener('click', function() {
                // Obtém o ID da mensagem a partir do atributo data-id do botão
                var idMensagem = this.getAttribute('data-id');
               
                console.log('ID da mensagem capturado: ' + idMensagem); // Log para ver o ID capturado
               
                // Envia o ID para um novo arquivo PHP (validar.php) via POST
                fetch('excluir.php', {
                    method: 'POST', // Verifica o método
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded', // Cabeçalho correto para POST
                    },
                    body: 'id_mensagem=' + encodeURIComponent(idMensagem) // Certifique-se de codificar o ID da mensagem
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro na requisição: ' + response.statusText);
                    }
                    return response.text();
                })
                .then(data => {
                    console.log('Resposta do servidor: ' + data); // Exibe a resposta do PHP no console
                    alert(data); // Mostra a resposta em um alerta para facilitar o teste
                })
                .catch(error => {
                    console.error('Erro:', error); // Exibe erros no console
                });
            });
        });
    </script>
</body>
</html>



