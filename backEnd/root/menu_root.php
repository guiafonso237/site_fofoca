<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Bem-Vindo</title>
</head>
<style>
    body{
        text-align: center;
        margin-top: 305px;
    }
</style>


<body>
    <h2>Bem-vindo, Root!</h2>
    <h4>Você tem o poder em suas mãos. O que deseja fazer?</h4>
    <a href='../usuario/outBd.php'><button>Ler mensagens Geral</button></a> <a href='outInv.php'><button>Validar</button></a> <a href='../usuario/write.html'><button>Escrever mensagens</button></a> <a href="usuarios.php"><button>Usuários</button></a>
</body>


</html>

