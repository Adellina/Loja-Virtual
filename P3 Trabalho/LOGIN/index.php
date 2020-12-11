<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    
    <title>Página de Login</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div id="corpo-form">
        <h1>Login</h1>
        <form action="processo-login.php" method="POST">
            <input type="email" name="email" placeholder="E- mail Usuário">
            <input type="password" name="senha" placeholder="Senha">
            <input type="submit" value="Acessar">
            <a href="cadastrar.php">Ainda não é inscrito?<strong>Cadastre-se</strong></a>
        </form>
    </div><br>
    <ul>
        <li><a href="../index.php">Sair</a></li>          
    </ul>
    
</body>
</html>