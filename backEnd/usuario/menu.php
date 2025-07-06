<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../creation/autenticacao.php");
    exit;
}
?>
<?php
    //header("refresh: 5");
    include("../config.php");

    $id = $_SESSION["user_id"];

    $sql = "SELECT estatus FROM usuario WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($estatus);
    $stmt->fetch();
    if($estatus == 0){
        header("location: ../index.html");
    }
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style/opcoes.css">
    <title>Escrever ou Ler</title>
</head>

<body>

    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <p>LOGO</p>
            </div>
        </nav>
    </div>


    <div class="container">
        <h1>O que você deseja fazer, <?php echo htmlspecialchars($_SESSION['username']); ?>?</h1>
        <br>
        <br>
        <input type="submit" value="Escrever" onclick="window.location.href='men.html';">
        <br><br>
        <input type="submit" value="Ler" onclick="window.location.href='outBd.php';">
    </div> 
</body>

</html>