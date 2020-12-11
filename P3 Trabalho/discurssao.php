<?php
session_start();
require_once 'CLASSES/comentarios.php';
$c = new Comentario('db-teste.caxyi8lsf2oe.us-east-1.rds.amazonaws.com','admin', '47171504','artesanato' );
$coments = $c->buscarComentarios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página de Comentários</title>
    <link rel="stylesheet" href="CSS/style-discurssao.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <?php
            //se a sessão for do master mostra botão "Área do administrador" e todos os outros 
            if(isset($_SESSION['id_master']))
            { ?>
                <li><a href="area-administrador.php">Área do administrador</a></li>
    <?php   }
                if(isset($_SESSION['id_usuario']) || isset($_SESSION['id_master']))
                { ?>
                    <li><a href="LOGIN/sair.php">Sair</a></li>
         <?php  }
                else
                { ?>
                    <li><a href="LOGIN/index.php">Entrar</a></li>
        <?php   }
            ?>
        </ul>
    </nav>
    <div id="largura-pagina">
    <?php
                // se a sessão for de usuario mostra apenas as abas de comentários 
                if(!isset($_SESSION['id_usuario']))
                { ?>
                    <h2>Comentários</h2>
        <?php   }
                else
                { ?>
                    <h2>Deixe seu Comentário!</h2>
        <?php   }
            ?>
  
    <section>
            <?php
                if(isset($_SESSION['id_usuario']))
                { ?>
                    <form method="post">
                        <img src="IMAGENS/perfil.png" alt="">
                        <textarea type="text" name="texto"  maxlength="390" placeholder=" Deixe seu comenario!"></textarea>
                        <input  type="submit"  class="botao-comentario" value="PLUBLICAR">
                    </form>
        <?php   }
                elseif(isset($_SESSION['id_master']))
                { ?>
                    <form method="post">
                        <img src="IMAGENS/perfil.png" alt="">
                        <textarea type="text" name="texto"  maxlength="390" placeholder=" Deixe seu comenario!"></textarea>
                        <input  type="submit"  class="botao-comentario" value="PLUBLICAR">
                    </form>
        <?php   }
            ?>
            <?php 
            if(count($coments) > 0 )
            {
                foreach ($coments as $v)
                { ?>
                    <div class="area-comentario">
                        <img src="IMAGENS/perfil.png"  alt="">
                        <h3><?php  echo $v['nome_pessoa']; ?></h3>
                        <h4>
                            <?php
                            $data = new DateTime($v['dia']);
                            echo $data->format('d/m/Y');
                            echo " - ";
                            echo $v['hora'];
                            ?>
                            <?php
                            if(isset($_SESSION['id_usuario']))
                            { 
                                // verificando se o comentário é do usuario logado
                                if($_SESSION['id_usuario'] == $v['pk_id_usuario'])
                                { ?>
                                    <a href="discurssao.php?id_exc=<?php echo $v['id_comentario'];?>">Excluir</a>
                    <?php      }
                            }
                            elseif(isset($_SESSION['id_master']))
                               { ?>
                                <a href="discurssao.php?id_exc=<?php echo $v['id_comentario'];?>" >Excluir</a>
                    <?php      }
                            ?>
                        <p><?php echo $v['comentario'];?></p>
                    </div>
        <?php   }
            }
            else
            {
                echo"Ainda não existem!";
            }
            ?>
        </section>
    </div>
</body>
</html>


<?php
//EXCLUIDO UM COMENTÁRIO
// pegando id de exclusão
if (isset($_GET['id_exc']))
{
    $id_e = addslashes($_GET['id_exc']);
    if(isset($_SESSION['id_master']))
    {
        $c->excluirComentario($id_e,$_SESSION['id_master']);
    }
    elseif (isset($_SESSION['id_usuario']))
    {
        $c->excluirComentario($id_e,$_SESSION['id_usuario']);
    }
    header("location: discurssao.php");
}
?>

<?php
//INSERINDO COMENTÁRIO NO BANCO DE DADOS
if(isset($_POST['texto']))
{
    $texto = addslashes($_POST['texto']);
    if(isset($_SESSION['id_master']))
    {
        $c->inserirComentario($_SESSION['id_master'], $texto);
    }
    elseif(isset($_SESSION['id_usuario']))
    {
        $c->inserirComentario($_SESSION['id_usuario'], $texto);
    }
   
    header("location:discurssao.php");
}
?>