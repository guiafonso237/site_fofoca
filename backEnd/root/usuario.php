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
    <h1>Usuários Bloquados</h1>
    <table id="Bloqueados">
        <tr>
            <th>Usuário</th>
            <th>Nome Completo</th>
            <th>ID</th>
            <th>Estatus</th>
        </tr>
        <?php
        // Inclua sua configuração de banco de dados
        include('../config.php');
       
        // Consulta para buscar as mensagens
        $consulta = "SELECT * FROM usuario ORDER BY id ASC";
        $resultado = mysqli_query($conn, $consulta);


        if (!$resultado) {
            echo "Erro ao executar a consulta: " . mysqli_error($conn);
            exit();
        }


        // Exibe as variáveis do banco de dados
        while($res = mysqli_fetch_array($resultado)){
            echo "<tr>";
            if($res['estatus'] == 0){
                echo "<td>" . $res["nome_usuario"] . "</td>";
                echo "<td>" . $res["nome_completo"] . "</td>";
                echo "<td>" . $res["id"] . "</td>";
                echo "<td>" . $res["estatus"] . "</td>";
                echo "<td><button class='validar' data-id='" . $res["id"] . "'>Liberar Acesso</button></td>";
                echo "<td><button class='excluir' data-id='" . $res["id"] . "'>Deletar Usuario</button></td>";
                echo "</tr>";header("Refresh: 3");
            }
        }
        ?>
    </table>




    <h1>Usuários Bloquados</h1>
    <table id="Bloqueados">
        <tr>
            <th>Usuário</th>
            <th>Nome Completo</th>
            <th>ID</th>
            <th>Estatus</th>
        </tr>
        <?php
        header("Refresh: 1");
        // Configuração de banco de dados
        include('../config.php');
       
        // Consulta para buscar as mensagens
        $consulta = "SELECT * FROM usuario ORDER BY id ASC";
        $resultado = mysqli_query($conn, $consulta);


        if (!$resultado) {
            echo "Erro ao executar a consulta: " . mysqli_error($conn);
            exit();
        }


        // Exibe as variáveis do banco de dados
        while($res = mysqli_fetch_array($resultado)){
            echo "<tr>";
            if($res['estatus'] == 1){
                echo "<td>" . $res["nome_usuario"] . "</td>";
                echo "<td>" . $res["nome_completo"] . "</td>";
                echo "<td>" . $res["id"] . "</td>";
                echo "<td>" . $res["estatus"] . "</td>";
                echo "<td><button class='bloquear' data-id='" . $res["id"] . "'>Vetar Acesso</button></td>";
                echo "</tr>";
            }header("Refresh: 1");
        }
        ?>
    </table>


    <!-- JavaScript -->
    <script>
        // Seleciona todos os botões com a classe "validar"
        var botoes = document.querySelectorAll('.validar');


        // Adiciona o evento de clique para cada botão
        botoes.forEach(function(botao) {
            botao.addEventListener('click', function() {
                // Obtém o ID a partir do atributo data-id do botão
                var id = this.getAttribute('data-id');
               
                console.log('ID capturado: ' + id); // Log para ver o ID capturado
               
                // Envia o ID para um novo arquivo PHP (validar.php) via POST
                fetch('liberar.php', {
                    method: 'POST', // Verifica o método
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded', // Cabeçalho correto para POST
                    },
                    body: 'id=' + encodeURIComponent(id) // Certifique-se de codificar o ID
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


<script>
        // Seleciona todos os botões com a classe "validar"
        var botoes = document.querySelectorAll('.excluir');


        // Adiciona o evento de clique para cada botão
        botoes.forEach(function(botao) {
            botao.addEventListener('click', function() {
                // Obtém o ID a partir do atributo data-id do botão
                var id = this.getAttribute('data-id');
               
                console.log('ID capturado: ' + id); // Log para ver o ID capturado
               
                // Envia o ID para um novo arquivo PHP (validar.php) via POST
                fetch('deletar.php', {
                    method: 'POST', // Verifica o método
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded', // Cabeçalho correto para POST
                    },
                    body: 'id=' + encodeURIComponent(id) // Certifique-se de codificar o ID
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




<script>
        // Seleciona todos os botões com a classe "validar"
        var botoes = document.querySelectorAll('.bloquear');


        // Adiciona o evento de clique para cada botão
        botoes.forEach(function(botao) {
            botao.addEventListener('click', function() {
                // Obtém o ID a partir do atributo data-id do botão
                var id = this.getAttribute('data-id');
               
                console.log('ID capturado: ' + id); // Log para ver o ID capturado
               
                // Envia o ID para um novo arquivo PHP (validar.php) via POST
                fetch('bloquear.php', {
                    method: 'POST', // Verifica o método
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded', // Cabeçalho correto para POST
                    },
                    body: 'id=' + encodeURIComponent(id) // Certifique-se de codificar o ID
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



