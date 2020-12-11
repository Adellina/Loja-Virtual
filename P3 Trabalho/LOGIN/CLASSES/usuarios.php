<?php

class Usuario
{   
    private $pdo;
    public $msgErro = "";

    public function conectar($host,$user,$passwd,$db)
    {
        $host = 'db-teste.caxyi8lsf2oe.us-east-1.rds.amazonaws.com';
        $user = 'admin';
        $passwd = '47171504';
        $db = 'artesanato';
    
        global $pdo;
    
        try {
            $pdo = new PDO("mysql:dbname=".$db.";host=".$host, $user,$passwd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
            
        }
    }


    public function cadastrar($nome,$telefone,$email,$senha)
    {
        global $pdo;
        //verificar se exite o email cadastrado
        $sql = $pdo->prepare("SELECT  id_usuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();

        if($sql->rowCount() > 0 )
        {
            return false; // Ja esta cadastrado
        }
        else
        {
            $sql = $pdo->prepare("INSERT INTO usuarios (nome,telefone,email,senha) VALUES (:n, :t, :e, :s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":t",$telefone);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;
        }
    }


    public function logar($email,$senha)
    {
        global $pdo;
        // verificar se o email e senha estão cadastrados
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            $dado = $sql->fetch();

            session_start();
            if($dado['id_usuario'] == 1)
            {
                //usuario administrador
            $_SESSION['id_master'] = 1 ;
            }
            else
            {
                //usuario comum
                $_SESSION['id_usuario'] = $dado['id_usuario'];
            }
            return true;
        }
        else
        {
            return false; // não exite no banco então não pode logar
        }
    }

    public function buscarDadosUser($id_usuario)

    {
        $host = 'db-teste.caxyi8lsf2oe.us-east-1.rds.amazonaws.com';
        $user = 'admin';
        $passwd = '47171504';
        $db = 'artesanato';

        global $pdo;
        try {
            $pdo = new PDO("mysql:dbname=".$db.";host=".$host, $user,$passwd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        
        }
       
        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = :id_usuario ");
        $sql->bindValue(":id_usuario",$id_usuario);
        $sql->execute();
        $dados = $sql->fetch();
        return  $dados;


    }

}



?>