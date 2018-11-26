<?php

class Denuncia{

    public function getTotalDenuncia(){
        global $pdo;

        $sql = $pdo->query("SELECT COUNT(*) as c FROM denuncias");
        $row = $sql->fetch();

        return $row['c'];

    }

    public function getMyDenuncias(){

        global $pdo;
        $array = array();

        $sql = $pdo->prepare("SELECT *, (select denuncias_imagens.url from denuncias_imagens where denuncias_imagens.id_denuncia = denuncias.id limit 1) as url FROM denuncias WHERE id_usuario = :id_usuario");
        $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;

    }



    public function setDenuncia($bairro, $cep, $descricao){
        global $pdo;

        $sql = $pdo->prepare("INSERT INTO denuncias (id_usuario, bairro, cep, descricao) 
        VALUES (:id_usuario, :bairro, :cep, :descricao)");
        $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":descricao", $descricao);
        $sql->execute();
    }


    public function editDenuncia($bairro, $cep, $descricao, $fotos, $id){
        global $pdo;

        $sql = $pdo->prepare("UPDATE denuncias SET id_usuario = :id_usuario, bairro = :bairro, cep = :cep, descricao = :descricao WHERE id = :id");
        $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if(count($fotos) > 0){
            for($q=0;$q<count($fotos['tmp_name']);$q++){
                $tipo = $fotos['type'][$q];
                if(in_array($tipo, array('image/jpeg', 'image/png'))){
                     $tmpname = md5(time().rand(0,9999)).'.jpg';
                     move_uploaded_file($fotos['tmp_name'][$q], 'assets/img/denuncias/'.$tmpname);
                     list($width_orig, $height_orig) = getimagesize('assets/img/denuncias/'.$tmpname);
                     $ratio = $width_orig/$height_orig;
                     $width = 500;
                     $height = 500;
                     if($width/$height > $ratio){
                         $width = $height*$ratio;
                     }else{
                         $height = $width/$ratio;
                     }
                     $img = imagecreatetruecolor($width, $height);
                     if($tipo == 'image/jpeg'){
                         $origi = imagecreatefromjpeg('assets/img/denuncias/'.$tmpname);
                     }else if($tipo == 'image/png'){
                         $origi = imagecreatefrompng('assets/img/denuncias/'.$tmpname);
                     }
                     imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                     imagejpeg($img, 'assets/img/denuncias/'.$tmpname, 80);
                     $sql = $pdo->prepare("INSERT INTO denuncias_imagens SET id_denuncia = :id_denuncia, url = :url");
                     $sql->bindValue(":id_denuncia", $id);
                     $sql->bindValue(":url", $tmpname);
                     $sql->execute();
                }
            }
        }


        //Consultar URL para pegar as imagens usado no For da linha 161
        $lista = array();

        $sql = $pdo->prepare("SELECT url
        FROM denuncias_imagens di
        INNER JOIN denuncias d ON di.id_denuncia = d.id WHERE d.id_usuario = :id_user");
        $sql->bindValue(":id_user", $_SESSION['cLogin']);
        $sql->execute();

        if($sql->rowCount() > 0){
            $lista = $sql->fetchAll();
        }
        /*
        var_dump($lista);

        for ($i=0; $i < count($lista); $i++) { 
          echo "Meus dados: ". $lista[$i]['url'];
        }

        exit;

        */

            ##Começo para enviar para o e-mail
                                    
                                 

            require 'PHPMailer/PHPMailerAutoload.php';
	
            $Mailer = new PHPMailer();
            
            //Define que será usado SMTP
            $Mailer->IsSMTP();
            
            //Enviar e-mail em HTML
            $Mailer->isHTML(true);
            
            //Aceitar carasteres especiais
            $Mailer->Charset = 'UTF-8';
            
            //Configurações
            $Mailer->SMTPAuth = true;
            $Mailer->SMTPSecure = 'ssl';
            
            //nome do servidor
            $Mailer->Host = 'br968.hostgator.com.br';
            //Porta de saida de e-mail 
            $Mailer->Port = 465;
            
            //Dados do e-mail de saida - autenticação
            $Mailer->Username = 'adm@lucasplpx.com.br';
            $Mailer->Password = 'F)p3.(b;Ns{1';
            
            //E-mail remetente (deve ser o mesmo de quem fez a autenticação)
            $Mailer->From = 'adm@lucasplpx.com.br';
            
            //Nome do Remetente
            $Mailer->FromName = 'Lucas Passos';
            
            //Assunto da mensagem
            $Mailer->Subject = 'Denuncia do '.$bairro;
            
            //Type of email
            $Mailer->isHTML(true);

            //Corpo da Mensagem
            $Mailer->Body = "Local: ".$bairro."<br/>"."Cep: ".$cep."<br/>"."Descricao: ".$descricao;
            
            //Corpo da mensagem em texto
            $Mailer->AltBody = 'conteudo do E-mail em texto';

            //Envia os anexos/As imagens
            for($i=0; $i < count($lista); $i++) { 
                $Mailer->AddAttachment('assets/img/denuncias/'. $lista[$i]['url']);
            }
            

            //Destinatario 
            $Mailer->AddAddress('limplus20@gmail.com');
            
            if($Mailer->Send()){
                echo "
                <div class='alert alert-success'>
                <strong>
                E-mail enviado com sucesso 
                </strong>
                <a href='my-denuncias.php' class='alert-link'>Verifique suas denuncias !</a>
                </div>
                ";
                exit;
            }else{
                echo "Erro no envio do e-mail: " . $Mailer->ErrorInfo;
                exit;
            }

            ##Fim de enviar para o e-mail

    }






    public function excluirDenuncia($id){
        global $pdo;

        $sql = $pdo->prepare("DELETE FROM anuncios_imagens WHERE id_denuncia = :id_denuncia ");
        $sql->bindValue(":id_denuncia", $id);
        $sql->execute();

        $sql = $pdo->prepare("DELETE FROM denuncias WHERE id = :id ");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function getDenuncia($id){
        global $pdo;
        $array = array();

        $sql = $pdo->prepare("SELECT * FROM denuncias WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();


        if($sql->rowCount() > 0){
            $array = $sql->fetch();
            $array['fotos'] = array();
            $sql = $pdo->prepare("SELECT id,url FROM denuncias_imagens WHERE id_denuncia = :id_denuncia");
            $sql->bindValue(":id_denuncia", $id);
            $sql->execute();
             if($sql->rowCount() > 0){
                 $array['fotos'] = $sql->fetchAll();
             }
         }           
         
         return $array;

    }


    public function excluirFoto($id){
        global $pdo;
        $id_anuncio = 0;

        $sql = $pdo->prepare("SELECT id_denuncia FROM denuncias_imagens WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $id_denuncia = $row['id_denuncia'];
        }
        $sql = $pdo->prepare("DELETE FROM denuncias_imagens WHERE id = :id ");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $id_anuncio;


    }
}

?>
