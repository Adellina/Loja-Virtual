<?php

require_once 'CLASSES/usuarios.php';

$u = new Usuario;

if(isset($_POST['nome']))

{
    $nome =addslashes($_POST['nome']);
    $telefone =addslashes($_POST['telefone']);
    $email =addslashes($_POST['email']);
    $senha =addslashes($_POST['senha']);
    $confSenha =addslashes($_POST['confSenha']);

    //verificar se todos os campos estão preenchidos
    if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confSenha))
    {
        $u->conectar('db-teste.caxyi8lsf2oe.us-east-1.rds.amazonaws.com','admin', '47171504','artesanato' );
        if($u->msgErro == "")
        {
            if($senha == $confSenha)
            {
                if($u->cadastrar($nome,$telefone,$email,$senha))
                {
                   
                    ?>
                    <script type="text/javascript">
                        alert('Produto cadastrado com sucesso!');
                    </script>
                    <?php
                }
                else
                {
                    ?>
                    <script type="text/javascript">
                        alert('Email já cadastrado!');
                    </script>
                    <?php
                }
            }
            else
            {
                ?>
                <script type="text/javascript">
                    alert('Senha e confirmar senha não correspondem!');
                </script>
                <?php
            }   
        }
        else
        {
            echo " Erro:".$u->msgErro;
        }
    }
    else
    {
        ?>
        <script type="text/javascript">
            alert('Preencha todos os campos!');
        </script>
        <?php
    }
}