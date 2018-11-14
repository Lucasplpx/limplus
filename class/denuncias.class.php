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

        $sql = $pdo->prepare("SELECT *, (select denuncias_imagens.url from denuncias_imagens where denuncias_imagens.id_anuncio = denuncias.id limit 1) as url FROM denuncias WHERE id_usuario = :id_usuario");
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


    public function editDenuncia($bairro, $cep, $descricao, $id){
        global $pdo;

        $sql = $pdo->prepare("UPDATE denuncias SET id_usuario = :id_usuario, bairro = :bairro, cep = :cep, descricao = :descricao WHERE id = :id");
        $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":id", $id);
        $sql->execute();
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

    }


    public function excluirFoto($id){
        global $pdo;
        $id_anuncio = 0;

        $sql = $pdo->prepare("SELECT id_denuncia FROM denuncias_imagens WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
}

?>
