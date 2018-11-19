<?php include 'template/header.php';?>


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
                            <span>Login</span>
                        </center>
                    </div>
                    <div class="card-body">
                        <form name="formCadastro" id="formCadastro" method="POST">    
                        <?php 
                            require 'class/usuarios.class.php';
                            $u = new Usuario();
                            if(isset($_POST['email']) && !empty($_POST['email'])){
                                $email = addslashes($_POST['email']);
                                $senha = md5(addslashes($_POST['senha']));
                                if($u->login($email, $senha)){
                                    ?>
                                    <script type="text/javascript">window.location.href="./"</script>
                                    <?php
                                } else {
                                    ?>
                                    <div class="alert alert-danger">
                                        Usuário e/ou Senha errados!
                                    </div>
                                    <?php
                                }
                                
                            }
                        ?>
                        <div class="form-row">                  
                            <div class="form-group col-md-7">    
                                <label for="email">E-mail:</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="senha">Senha:</label>
                                <input type="password" name="senha" id="senha" class="form-control">
                            </div>
                             
                        </div>
                                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-dark">Entrar</button>
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