<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Moderador - TipoNetflix</title>
    <link rel="stylesheet" href="../css/cadastro.css">
</head>
<body>

    <h1>Cadastro de Moderador</h1>

     <form method="POST" action="../projetonetflix/processamento/processaModerador.php">

        <label>Nome</label>
        <input type="text" name="inputNome"
            placeholder="Digite seu nome" required>

        <label>E-mail</label>
        <input type="email" name="inputEmail"
            placeholder="Digite seu e-mail" required>

        <label>Senha:</label>
        <input type="password" name="inputSenha"
            placeholder="Digite sua senha" required>

        <label>Confirmar senha:</label>
        <input type="password" name="inputConfirmarSenha"
            placeholder="Confirme sua senha" required>

        <button type="submit">Cadastrar</button>

    </form>

    <a href="formLoginModerador.php">Já possui uma conta? Faça login</a>

</body>
</html>
