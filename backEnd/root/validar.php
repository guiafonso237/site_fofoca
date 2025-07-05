<?php
// Habilitar exibição de erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include('../config.php'); // Certifique-se de que o caminho para config.php está correto


// Verifica se a requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o ID foi enviado
    if (isset($_POST['id_mensagem'])) {
        $idMensagem = $_POST['id_mensagem'];
       
        // Exibir o ID recebido para debug
        echo "ID recebido: " . $idMensagem;


        // Exemplo de consulta para validar a mensagem no banco de dados
        $sql = "UPDATE mensagens SET estatus = 1 WHERE id_men = ?";
        $stmt = $conn->prepare($sql);
       
        if ($stmt === false) {
            die("Erro ao preparar a consulta: " . $conn->error);
        }
       
        $stmt->bind_param("i", $idMensagem);


        if ($stmt->execute()) {
            echo "Mensagem com ID " . $idMensagem . " validada com sucesso.";
        } else {
            echo "Erro ao validar a mensagem: " . $stmt->error;
        }


        $stmt->close();
        mysqli_close($conn);
    } else {
        echo "Nenhum ID de mensagem foi enviado.";
    }
} else {
    echo "Método de requisição inválido. Esperado POST.";
}
?>



