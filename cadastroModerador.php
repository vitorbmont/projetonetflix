<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Moderador - FatecFlix</title>

    <link rel="stylesheet" href="css/cadastrarModerador.css">
</head>

<body>

    <header>
        <h1>Tipo Netflix</h1>
        <a href="loginModerador.php">Já possui uma conta? Entrar</a>
    </header>

    <main>

        <div class="cadastro">

            <h2>Cadastro de moderador</h2>
            <p>Preencha os dados abaixo para criar sua conta de moderador.</p>

            <form method="POST" action="processamento/processaModerador.php">

                <label>Nome</label>
                <input type="text" name="inputNome"
                    placeholder="Digite seu nome" required>

                <label>E-mail</label>
                <input type="email" name="inputEmail"
                    placeholder="Digite seu e-mail" required>

                <label>Senha</label>
                <input type="password" name="inputSenha"
                    placeholder="Crie uma senha" required>

                <label>Confirmar senha</label>
                <input type="password" name="inputConfirmarSenha"
                    placeholder="Digite a senha novamente" required>

                <button type="submit">Cadastrar</button>

            </form>

        </div>

    </main>

</body>
</html>