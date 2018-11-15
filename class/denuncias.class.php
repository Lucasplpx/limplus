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
