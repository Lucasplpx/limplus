<?php require 'connection/config.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/upload.css">
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/upload.js"></script>
    <script src="assets/js/script.js"></script>
    <title>LimPlus</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="./">LimPlus</a>
        <div class="collapse navbar-collapse" >
            <ul class="navbar-nav mr-right">
                <?php if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])): ?>
                <li class="nav-item active"><a class="nav-link" href="my-denuncias.php">Usuário -> <?php include 'class/usuarios.class.php'; $u = new Usuario; $nome = $u->getNomeUsuario($_SESSION['cLogin']); echo $nome; ?></a></li>
                <li class="nav-item active"><a class="nav-link" href="my-denuncias.php">Minhas Denuncias</a></li>
                <li class="nav-item active"><a class="nav-link" href="sair.php">Sair</a></li>
                
                <?php else: ?>           
                    
                <li class="nav-item active"><a class="nav-link" href="cadastre-se.php">Cadastre-se</a></li>
                <li class="nav-item active"><a class="nav-link" href="login.php">Login</a></li>
                <?php endif;?>
            </ul>
        </div>
    </nav>