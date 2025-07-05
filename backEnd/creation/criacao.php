<?php
    session_start();
    include('../config.php');
    echo "<style>body{background-color: #A9A9A9;}</style>";
    // Sanitizar entrada de dados
    $full_name = htmlspecialchars($_POST["name"]);
    $user = htmlspecialchars($_POST["user_name"]);
    $senha = htmlspecialchars($_POST["senha"]);

    $sql = "SELECT id FROM usuario WHERE nome_usuario = ?";
        $test = $conn->prepare($sql);
        $test->bind_param("s", $user);
        $test->execute();
        $test->store_result();

        if ($test->num_rows > 0) {
            // Caso o nome de usuÃ¡rio jÃ¡ exista 
            echo "<script>alert('Nome de usuÃ¡rio jÃ¡ existente');window.location='../index.html';</script>";
        }else{
 
            // Usar prepared statement para evitar SQL injection
            $stmt = $conn->prepare("INSERT INTO usuario (nivel, estatus, nome_usuario, senha, nome_completo) VALUES (1, 1, ?, ?, ?)");
            $stmt->bind_param("sss", $user, $senha, $full_name);

            // Executar a query e verificar resultado
            if ($stmt->execute()) {
                header('Location: ../index.html');
            } else {
                echo "<br>Erro: " . $stmt->error;
            }
        }
    // Fechar a conexÃ£o
    $test->close();
    $stmt->close();
    $conn->close();
?>


