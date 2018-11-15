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
       
        $id = intval(addslashes($_GET['id']));
        if(isset($_FILES['fotos'])){
            $fotos = $_FILES['fotos'];
        }else{
            $fotos = array();
        }  
        
        $a->editDenuncia($bairro, $cep, $descricao, $fotos, $id);
   
        ?>
            <div class="alert alert-success">
                Denuncia editada com sucesso!
            </div>

        <?php
    }
    $info = array();
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $ad = new Denuncia();
        $id = $_GET['id'];
        $info = $ad->getDenuncia($id);
    } else {
        header("Location: my-denuncias.php");
        exit;
    }
    
?>

<div class="container">
    <h1>Minhas Denuncias - Editar Denuncia</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="bairro">Bairro:</label>
            <input type="text" name="bairro" id="bairro" class="form-control" value="<?php echo $info['bairro'];?>">
        </div>

        <div class="form-group">
            <label for="cep">Cep:</label>
            <input type="text" name="cep" id="cep" class="form-control" value="<?php echo $info['cep'];?>">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="5"><?php echo $info['descricao'];?></textarea>
        </div>

        <div class="form-group">
            <label for="add_foto">Fotos da Denuncia:</label><br>
            <input type="file" name="fotos[]" multiple /> <br><br>
            
        <div class="card">
            <div class="card-header">
                Fotos já Enviadas
            </div>
            <div class="card-body">
                <?php foreach ($info['fotos'] as $foto):
                ?>
                <div class="foto_item">
                    <img src="assets/img/denuncias/<?php echo $foto['url']; ?>" class="img-thumbnail"><br>
                    <a href="excluir-foto.php?id=<?php echo $foto['id'];?>" class="btn btn-outline-danger">Excluir Imagem</a>
                </div>

                <?php endforeach;?>
        
            </div>
        </div>
        </div>

        <input type="submit" value="Salvar" class="btn btn-outline-primary">
    </form>

</div>


<?php include 'template/footer.php'?>