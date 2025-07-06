<?php
    include ('../config.php');
    session_start();
    $id = $_SESSION['user_id'];
    $men = $_POST["mensagem"];
    $val= "SELECT estatus FROM usuario WHERE id = ?";
    $smt = $conn->prepare($val);
    $smt->bind_param("s", $id);
    $smt->execute();
    $smt->store_result();
    $smt->bind_result($estatus);
    $smt->fetch();

    if($id == 0){
        $stmt = $conn->prepare("INSERT INTO mensagens (mensagem, id, estatus) VALUES (?, ?, 1)");

        $stmt->bind_param("ss", $men, $id);
        if ($stmt->execute()) {
            header('Location: ../root/menu_root.php');
        } else {
            echo "<br>Erro: " . $stmt->error;
        }
    }else{
        
        $stmt = $conn->prepare("INSERT INTO mensagens (mensagem, id, estatus) VALUES (?, ?, 0)");

        $stmt->bind_param("ss", $men, $id);
        if($estatus == 0){
            header("../index.html");
        }else{
            if ($stmt->execute()) {
                header('Location: menu.php');
            } else {
                echo "<br>Erro: " . $stmt->error;
            }
        }
        
    }
?>