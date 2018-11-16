<?php include 'template/header.php';?>


<div class="container">

    <h1>Cadastre-se</h1>

    <?php 
        require 'class/usuarios.class.php';
        $u = new Usuario();
        if(isset($_POST['nome']) && !empty($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = md5(addslashes($_POST['senha']));
            $telefone = addslashes($_POST['telefone']);
            if(!empty($nome) && !empty($email) && !empty($senha)){
                if($u->cadastrar($nome, $email, $senha, $telefone)){
                    ?>
                        <div class="alert alert-success">
                            <strong>Cadastrado com sucesso!</strong> <a href="login.php" class="alert-link">Faça o login agora !</a>
                        </div>
                    <?php
                }else {
                    ?>
                        <div class="alert alert-warning">
                            <strong>Este usuário já existe!</strong> <a href="login.php" class="alert-link">Faça o login agora !</a>
                        </div>
                    <?php
                }
            } else {
                ?>
                    <div class="alert alert-warning">
                        Preencha todos os campos!
                    </div>
                <?php
            }
            
        }
?>

<div class="container">
    <div class="row" style="margin-bottom: 40px;">
            <div class="col-sm-3">

            </div>

            <div class="col-sm-6">
         
                <img src="assets/img/prefe.png" class="rounded float-left" alt="Responsive image">
              
            </div>
            <div class="col-sm-3"></div>
        </div>


        <div class="row">

            <div class="col-sm-3"></div>

            <div class="col-sm-6">

                <div class="card border-dark mb-3">
                    <div class="card-header bg-transparent border-dark">
                        <center>
                            <span>Preencha as informações</span>
                        </center>
                    </div>
                    <div class="card-body">
                        <form name="formCadastro" id="formCadastro" method="POST">    
                        <div class="form-row">                      
                            <div class="form-group col-md-7">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex.: Nome Sobrenome">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="telefone">Celular</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Ex.: (00) 0000-0000">
                            </div>
                        </div>
                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <label for="email">E-mail</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Ex.: teste@exm.com">
                                </div>

                                <div class="form-group col-md-5">
                                    <label for="senha">Senha</label>
                                    <input type="password" name="senha" id="senha" class="form-control">
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