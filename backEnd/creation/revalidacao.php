<?php
    include("../config.php");

    $id = $_SESSION["id"];

    $sql = "SELECT estatus FROM usuario WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($estatus);
    $stmt->fetch();
    if($estatus == 0){
        header("../index.html");
    }
?>

