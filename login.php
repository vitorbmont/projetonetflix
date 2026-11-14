<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - TipoNetflix</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="formulario">
        <h2>Entrar no TipoNetflix</h2>
        <form action="login.php" method="POST">

        <h2>Entrar na TipoNetflix</h2>
        <form action="../projetonetflix/processamento/processamento.php" method="POST">

            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">ENTRAR</button>
        </form>
    </div>
</body>
</html>