<?php
session_start();
if(!isset($_SESSION['id_master']))
{
    header("location:index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    
    <title>Página do Administrador</title>
    <link rel="stylesheet" href="CSS/style-administrador.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="discurssao.php">Comentários</a></li>
            <li><a href="LOGIN/sair.php">Sair</a></li>
        </ul>
    </nav>  
    <section>
        <form method="post" enctype="multipart/form-data">
            <h1>Cadastrar Produto</h1>
            <label for="nome">Nome do Produto</label>
            <input type="text" name="nome" id="nome">
            <input type="file" name="foto"  class= "escolher-foto" >
            <input type="submit" id="botao" class="botao1" value="Cadastrar">
        </form>
        <a  class="tela-produto" href="index.php">Tela de Produtos</a>
    </section>
    <section>
            <form method="POST" action="LOGIN/processo-cadastro.php" >
            <h1>Cadastrar Usuário</h1>
            <input type="text" name="nome" placeholder="Nome Completo" maxlength="80">
            <input type="text" name="telefone" placeholder="Telefone" maxlength="80">
            <input type="email" name="email" placeholder="E- mail Usuário" maxlength="80">
            <input type="password" name="senha" placeholder="Senha" maxlength="32">
            <input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="15">
            <input type="submit" value="Cadastrar" class="botao1">
        </form>
        <a  class="tela-produto" href="listasUsuarios.php">Tela de Usuários</a>
    </section>
</body>

<?php

$host = 'db-teste.caxyi8lsf2oe.us-east-1.rds.amazonaws.com';
$user = 'admin';
$passwd = '47171504';
$db = 'artesanato';
try {
    $pdo = new PDO("mysql:dbname=".$db.";host=".$host, $user,$passwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $msgErro = $e->getMessage();
}
if(isset($_POST['nome']))
{
    $nome = addslashes($_POST['nome']);
    if(isset($_FILES['foto']))
    $nome_arquivo = md5($_FILES['foto']['name'].rand(1,999)).'.jpg';
    {
        move_uploaded_file($_FILES['foto']['tmp_name'], 'IMAGENS/'.$nome_arquivo);

            // validação dos campos
            if(!empty($nome))
            {
            //inserindo o produto na tabela produto
            $sql = $pdo->prepare("INSERT INTO  produto (nome, imagem) VALUES (:n, :i)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":i",$nome_arquivo);
            $sql->execute();
            ?>
                <script type="text/javascript">
                    alert('Produto cadastrado com sucesso!');
                </script>
                <?
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
}

?>