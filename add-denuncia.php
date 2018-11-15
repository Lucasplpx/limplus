<?php include 'template/header.php'?>
<?php
    if(empty($_SESSION['cLogin'])){
    ?>
        <script type="text/javascript">window.location.href="login.php"</script>
    <?php
    exit;
    }
   
    include 'class/denuncias.class.php';
    if(isset($_POST['bairro']) && !empty($_POST['bairro'])){
        $a = new Denuncia();
        $bairro = addslashes($_POST['bairro']);
        $cep = addslashes($_POST['cep']);
        $descricao = addslashes($_POST['descricao']);
        $a->setDenuncia($bairro, $cep, $descricao);
        ?>
            <div class="alert alert-success">
                Denuncia enviada com sucesso!
            </div>

        <?php
    }
?>

<div class="container">
    <h1>Minhas Denuncias - Adicionar Denuncia</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="bairro">Bairro:</label>
            <input type="text" name="bairro" id="bairro" class="form-control">
        </div>

        <div class="form-group">
            <label for="cep">Cep:</label>
            <input type="text" name="cep" id="cep" class="form-control">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="10"></textarea>
        </div>


        <input type="submit" value="Enviar" class="btn btn-outline-primary">
    </form>

</div>


<?php include 'template/footer.php'?>