<?php include 'template/header.php'?>


<div class="container">
    <div class="row" style="margin-bottom: 40px;">
            <div class="col-sm-3">

            </div>

            <div class="col-sm-6">
                <div class="d-flex justify-content-center">
                    <img src="assets/img/prefe.png" class="rounded float-left" alt="Responsive image">
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>


            <div class="row">

                <div class="col-sm-3"></div>

                <div class="col-sm-6">

                    <div class="card border-dark mb-3">
                        <div class="card-header bg-transparent border-dark">
                            <center>
                                <span>Editar Denuncia</span>
                            </center>
                        </div>
                        <div class="card-body">
                            <form name="formCadastro" id="formCadastro" method="POST" enctype="multipart/form-data">  

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

                        <div class="form-row">                      
                            <div class="form-group col-md-7">
                                <label for="bairro">Bairro</label>
                                <input type="text" class="form-control" id="bairro" name="bairro"  value="<?php echo $info['bairro'];?>">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="cep">Cep</label>
                                <input type="text" class="form-control" id="cep" name="cep"  value="<?php echo $info['cep'];?>" placeholder="Ex.: 00000-000">
                            </div>
                        </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="descricao">Descrição:</label>
                                <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="5"><?php echo $info['descricao'];?></textarea>
                                </div>
							</div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="add_foto">Fotos da Denuncia:</label><br>
                                    <!-- Começo do codigo -->
                                    <p>Utilize a tecla <b>Ctrl</b> para selecionar mais de um arquivo.</p>
                                    <div id="multiple_upload">
                                        <input type="file" name="fotos[]" multiple="multiple" id="uploadChange" />
                                        <div id="message">Selecionar fotos</div>
                                        <input type="button" id="botao" value="Upload" />
                                    <div id="lista">
                                </div>
                            </div>

                            </div>

                
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
                   

                                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-dark">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <!-- fim .card-body -->
                    <div class="card-footer border-dark">
                        <center>
                            <small class="text-muted">&copy; LimpPlus Team 2018</small>
                        </center>
                    </div>
                </div>
                <!-- fim .card -->
            </div>
            <div class="col-sm-3"></div>
        </div>
</div>


<?php include 'template/footer.php'?>