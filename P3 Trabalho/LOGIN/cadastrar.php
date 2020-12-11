<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    
    <title>Página de Login</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div id="corpo-form-cad">
        <h1>Cadastrar</h1>
        <form method="POST" action="processo-cadastro.php" >
            <input type="text" name="nome" placeholder="Nome Completo" maxlength="80">
            <input type="text" name="telefone" placeholder="Telefone" maxlength="80">
            <input type="email" name="email" placeholder="E- mail Usuário" maxlength="80">
            <input type="password" name="senha" placeholder="Senha" maxlength="32">
            <input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="15">
            <input type="submit" value="Cadastrar">
        </form>
        <a href="index.php">Já é Cadastrado?<strong>Logar</strong></a><br>
        <ul>
        <li><a href="../index.php">Sair</a></li>          
    </ul>
    </div>
    
</body>
</html>