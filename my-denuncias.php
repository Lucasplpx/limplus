<?php include 'template/header.php'?>
<?php
    if(empty($_SESSION['cLogin'])){
    ?>
        <script type="text/javascript">window.location.href="login.php"</script>
    <?php
    exit;
    }
?>
<div class="container">
    <h1>Minhas Denuncias</h1>

    <a href="add-denuncia.php" class="btn btn-outline-dark">Adicionar Denuncia</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Bairro</th>
                <th>Cep</th>
                <th>Data da Denuncia</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php 
        include 'class/denuncias.class.php';
        $a = new Denuncia();
        $denuncias = $a->getMyDenuncias();
        foreach ($denuncias as $denuncia):
        ?>
        <tr>
            <td>
            <?php if(!empty($denuncia['url'])):?>
                <img src="assets/img/denuncias/<?php echo $denuncia['url'];?>"  height="100px" alt="res">
            <?php else:?>
                <img src="assets/img/denuncias/default.png" height="50px" alt="res">
            <?php endif;?>
            </td>
            <td><?php echo $denuncia['bairro']?></td>
            <td><?php echo $denuncia['cep']?></td>
            <td><?php echo  date_format(new DateTime($denuncia['data_denuncia']), 'd/m/Y H:i:s'); ?></td>
            <td>
            <a href="editar-denuncia.php?id=<?php echo $denuncia['id'];?>" class="btn btn-outline-primary">Editar</a>
            <a href="excluir-denuncia.php?id=<?php echo $denuncia['id'];?>" class="btn btn-outline-danger">Excluir</a>
            </td>
        </tr>
        <?php
        endforeach;
        ?>
    </table>

</div>


<?php include 'template/footer.php'?>