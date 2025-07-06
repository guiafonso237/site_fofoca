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
            </tr>
    <?php
        session_start();
        include('../config.php');

        header("refresh: 5");

        $id = $_SESSION["user_id"];

        $val = "SELECT estatus FROM usuario WHERE id = ?";
        $smt = $conn->prepare($val);
        $smt->bind_param("s", $id);
        $smt->execute();
        $smt->store_result();
        $smt->bind_result($estatus);
        $smt->fetch();
        if($estatus == 0){
            header("location: ../index.html");
        }
        header("Refresh: 10");
        $consulta = "SELECT * FROM mensagens ORDER BY id_men DESC";


        // Executa a consulta
        $resultado = mysqli_query($conn, $consulta);


        // Verifica se a consulta foi bem-sucedida
        if (!$resultado) {
            echo "Erro ao executar a consulta: " . mysqli_error($conn);
            exit();
        }
        // Exibe as variáveis do banco de dados
        while($res = mysqli_fetch_array($resultado)){echo "<tr>";
            $sql = "SELECT nome_usuario FROM usuario WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $res["id"]);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($nName);
            $stmt->fetch();
            if($res['estatus'] == 1){
                echo "<td>" . $nName . "</td><td>" . $res["mensagem"] . "</td>";
                header("Refresh: 2");
                echo "</tr>";
            }
            header("Refresh: 2");
        }
    
        // Fecha a conexão
        mysqli_close($conn);
        $stmt->close();
        $conn->close();
    ?>
</body>
</html>