<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - TipoNetflix</title>

    <link rel="stylesheet" href="css/cadastro.css">
</head>

<body>

    <header>
        <h1>Tipo Netflix</h1>
        <a href="login.php">Já possui uma conta? Entrar</a>
    </header>

    <main>

        <div class="cadastro">

            <h2>Criar sua conta</h2>
            <p>Coloque os seu dados abaixo para criar sua conta no TipoNetflix.</p>

            <form method="POST" action="../projetonetflix/processamento/processamento.php">

                <label>Nome</label>
                <input type="text" name="inputNome"
                    placeholder="Digite seu nome" required>

                <label>Sobrenome</label>
                <input type="text" name="inputSobrenome"
                    placeholder="Digite seu sobrenome" required>

                <label>E-mail</label>
                <input type="email" name="inputEmail"
                    placeholder="Digite seu e-mail" required>

                <label>Data de nascimento</label>
                <input type="date" name="inputNascimento" required>

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
