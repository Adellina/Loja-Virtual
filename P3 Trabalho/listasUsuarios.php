<?php
require_once 'LOGIN/CLASSES/usuarios.php';
session_start();

if(isset($_SESSION['id_usuario']))
{
    $u = new Usuario('db-teste.caxyi8lsf2oe.us-east-1.rds.amazonaws.com','admin', '47171504','artesanato' ); 
    $informacoes = $u->buscarDadosUser($_SESSION['id_usuario']);
}
elseif(isset($_SESSION['id_master']))
{
    $u = new Usuario('db-teste.caxyi8lsf2oe.us-east-1.rds.amazonaws.com','admin', '47171504','artesanato' ); 
    $informacoes = $u->buscarDadosUser($_SESSION['id_master']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    
    <title>Página de Inicial</title>
    <link rel="stylesheet" href="CSS/style.css">
    
</head>
<body>
    <nav>
        <ul>
        <?php
            if(isset($_SESSION['id_master']))
            { ?>
                <li><a href="area-administrador.php">Área do administrador</a></li>
                <li><a href="index.php">Inicio</a></li>
    <?php   }
        ?>
            <li><a href="discurssao.php">Comentários</a></li>
            <?php
                if (isset($informacoes)) // tem uma sessão aberta
                { ?>
                    <li><a href="LOGIN/sair.php">Sair</a></li>
        <?php   }
                else
                { ?>
                    <li><a href="LOGIN/index.php">Entrar</a></li>
        <?php   }

            ?>
        </ul>
    </nav>
<?php
if(isset($_SESSION['id_master']) || isset($_SESSION['id_usuario']))
{ ?>
<h5>
    <?php 
    echo "Olá ";
    echo $informacoes ['nome'];
    echo " , seja bem vindo(a)!";
    ?>
</h5>
<?php }
?>
<section>
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
        $sql = 'SELECT * FROM usuarios';
        $result = $pdo->prepare($sql);
        $result->execute();
        $lista = $result->fetchAll(PDO::FETCH_OBJ);
                   
        ?> 
 
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Nome</th>
                <th scope="col">Telefone</th>
                <th scope="col">e-mail</th>
                <th scope="col">senha</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($lista as $usuarios) { ?> 
                <tr>
                <td scope="col"><?php echo "{$usuarios->id_usuario}";?></td> 
                <td scope="col"><?php echo "{$usuarios->nome}"; ?></td> 
                <td scope="col"><?php echo "{$usuarios->telefone}"; ?></td> 
                <td scope="col"><?php echo "{$usuarios->email}"; ?></td> 
                <td scope="col"><?php echo "{$usuarios->senha}"; ?></td> 
                </tr>
            <?php } ?>
            </tbody>
            
        </table>
    
    

</section>
</body>
</html>