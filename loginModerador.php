<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Moderador - FatecFlix</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="formulario">
        <h2>Entrar como Moderador</h2>

        <form method="POST" action="processamento/processaModerador.php">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            
            <button type="submit">ENTRAR</button>
        </form>

        <p><a href="cadastroModerador.php">Criar conta de moderador</a></p>
        <p><a href="loginUsuario.php">Entrar como usuário</a></p>
    </div>
</body>
</html>