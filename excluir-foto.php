<?php
include 'connection/config.php';
if(empty($_SESSION['cLogin'])){
    header("Location: login.php");
    exit;
}
include 'class/denuncias.class.php';
$a = new Denuncia();
if(isset($_GET['id']) && !empty($_GET['id'])){
    
    $id = intval(addslashes($_GET['id']));
    
    $id_denuncia = $a->excluirFoto($id);
}
if(isset($id_denuncia)){
    header("Location: editar-denuncia.php?id=".$id_denuncia);
}else{
    header("Location: my-denuncias.php");
}
?>