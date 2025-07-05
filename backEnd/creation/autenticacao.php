<?php
session_start();
include('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos 'username' e 'password' foram enviados via POST
    if(isset($_POST['username'], $_POST['password'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $sql = "oi";
        // Consulta SQL para buscar o usuÃ¡rio com nome de usuÃ¡rio e estatus vÃ¡lido
        if($username != "root"){
            $sql = "SELECT id, senha FROM usuario WHERE nome_usuario = ? AND estatus = 1";
        }else{
            $sql = "SELECT id, senha FROM usuario WHERE nome_usuario = ? AND estatus = 2";
        }
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0 || $username=="root") {
            // Se o usuÃ¡rio existe, vincula o resultado da senha
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();
            // Verifica se a senha fornecida corresponde Ã  senha hash no banco de dados
            if ($password == $hashed_password) {
                // Se a senha estiver correta, define as variÃ¡veis de sessÃ£o e redireciona para a pÃ¡gina de boas-vindas
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $id; // Se precisar usar o ID do usuÃ¡rio posteriormente

                if($username == "root"){
                    header("location: ../root/menu_root.php");
                }else{
                    header("location: ../usuario/menu.php");
                }
                
                exit;
            } else {
                // Caso a senha seja incorreta
                echo "<h1>Senha incorreta.</h1>";
            }
        } else {
            // Caso o usuÃ¡rio nÃ£o seja encontrado ou o estatus nÃ£o seja 1
            $sql = "SELECT estatus FROM usuario WHERE nome_usuario = ?";
            $smt = $conn->prepare($sql);
            $smt->bind_param("s", $username);
            $smt->execute();
            $smt->store_result();
            $smt->bind_result($estatus);
            $smt->fetch();

            if($estatus < 1){
                echo "UsuÃ¡rio bloqueado!";
            }else{
                echo "UsuÃ¡rio nÃ£o encontrado.";
            }
           
        }

        $stmt->close();
    } else {
        // Se os campos nÃ£o foram enviados via POST
        echo "Por favor, preencha todos os campos.";
    }
}

$conn->close();
?>


