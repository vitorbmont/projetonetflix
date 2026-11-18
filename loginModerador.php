<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login de Moderador - TipoNetflix</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <h1>Login de Moderador</h1>

    <form method="POST" action="../projetonetflix/processamento/processarFilmeSerie.php">

        <input type="email" name="email" required>

        <input type="password" name="senha" required>

        <button type="submit">Entrar</button>

    </form>

</body>
</html>
