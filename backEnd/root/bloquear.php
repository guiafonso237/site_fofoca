<?php
// Habilitar exibição de erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include('../config.php'); // Certifique-se de que o caminho para config.php está correto


// Verifica se a requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o ID foi enviado
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
       
        // Exibir o ID recebido para debug
        //echo "ID recebido: " . $id;


        // Exemplo de consulta para validar o usuario no banco de dados
        $sql = "UPDATE usuario SET estatus=0 WHERE id= ?";
        $stmt = $conn->prepare($sql);
       
        if ($stmt === false) {
            die("Erro ao preparar a consulta: " . $conn->error);
        }
       
        $stmt->bind_param("i", $id);


        if ($stmt->execute()) {
            echo "Usuario com ID " . $id . " bloqueado com sucesso.";
        } else {
            echo "Erro ao validar o Usuario: " . $stmt->error;
        }


        $stmt->close();
        mysqli_close($conn);
    } else {
        echo "Nenhum ID foi enviado.";
    }
} else {
    echo "Método de requisição inválido. Esperado POST.";
}
?>



