<?php include 'template/header.php'?>

<?php
include 'class/denuncias.class.php';
$a = new Denuncia();

$total_denuncia = $a->getTotalDenuncia();
$total_usuarios = 321;
?>
    <div class="container-fluid">
        <div class="jumbotron">
            <h2>Nós temos hoje <?php echo $total_denuncia; ?> denuncias.</h2>
            <p>E mais de <?php echo $total_usuarios; ?>  usuários cadastrados.</p>
        </div>
    
        <div class="row">
            <div class="col-sm-3">
                <h4>Pesquisa Avançada</h4>
            </div>
            <div class="col-sm-9">
                <h4>Últimos Anúncios</h4>
            </div>
        </div>

    </div>

<?php include 'template/footer.php'?>