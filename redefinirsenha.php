<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - TipoNetflix</title>

    <link rel="stylesheet" href="css/redefinirsenha.css">
</head>

<body>

    <header>
        <h1>TipoNetflix</h1>
    </header>

    <main>

        <div class="redefinir">

            <h2>Redefinir senha</h2>

            <p>Informe seu e-mail e escolha uma nova senha para sua conta.</p>

            <form action="redefinirsenha.php" method="POST">

                <label>E-mail cadastrado</label>
                <input type="email" name="inputEmail"
                    placeholder="Digite seu e-mail" required>

                <label>Nova senha</label>
                <input type="password" name="inputSenha"
                    placeholder="Digite sua nova senha" required>

                <label>Confirmar nova senha</label>
                <input type="password" name="inputConfirmarSenha"
                    placeholder="Digite a senha novamente" required>

                <button type="submit">Redefinir senha</button>

            </form>

            <a href="login.php">Voltar para o login</a>

        </div>

    </main>

</body>
</html>