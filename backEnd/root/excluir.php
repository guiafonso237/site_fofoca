<?php
// Habilitar exibição de erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include('../config.php');


// Verifica se a requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o ID foi enviado
    if (isset($_POST['id_mensagem'])) {
        $id = $_POST['id_mensagem'];
       
        // Exibir o ID recebido para debug
        //echo "ID recebido: " . $id;


        // Exemplo de consulta para validar o usuario no banco de dados
        $sql = "DELETE FROM mensagens WHERE id_men= ?";
        $stmt = $conn->prepare($sql);
       
        if ($stmt === false) {
            die("Erro ao preparar a consulta: " . $conn->error);
        }
       
        $stmt->bind_param("i", $id);


        if ($stmt->execute()) {
            echo "Mensagem com ID: " . $id . " deletada com sucesso.";
        } else {
            echo "Erro." . $stmt->error;
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

