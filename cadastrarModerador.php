<?php
$mensagem = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['inputNome'] ?? '';
    $email = $_POST['inputEmail'] ?? '';
    $nivel = $_POST['nivelAcesso'] ?? 'comum';
    $senha = $_POST['inputSenha'] ?? '';

    $mensagem = "Moderador \"" . htmlspecialchars($nome) . "\" cadastrado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Moderador - TipoNetflix</title>
    <link rel="stylesheet" href="css/cadastrarModerador.css">
</head>
<body>

    <header>
        <h1>TipoNetflix</h1>
        <a href="principal.php">Voltar ao Início</a>
    </header>

    <main>
        <div class="cadastro" style="max-width: 500px; margin: auto;">
            
            <h2>Novo Moderador</h2>
            <p>Preencha os dados abaixo para registrar um novo acesso administrativo.</p>

            <?php if (!empty($mensagem)) { ?>
                <p style="color: #46d369; font-weight: bold; margin-bottom: 15px;"><?php echo $mensagem; ?></p>
            <?php } ?>

            <form action="cadastrarModerador.php" method="POST">

                <label>Nome Completo</label>
                <input type="text" name="inputNome" placeholder="Digite o nome do moderador" required>

                <label>E-mail Corporativo</label>
                <input type="email" name="inputEmail" placeholder="Digite o e-mail de acesso" required>

                <label>Nível de Moderação</label>
                <select name="nivelAcesso" required style="padding: 12px; margin-bottom: 18px; border: 1px solid #555; border-radius: 4px; background-color: #333; color: white; width: 100%;">
                    <option value="junior">Moderador Júnior (Aprovar Conteúdos)</option>
                    <option value="senior">Moderador Sênior (Gerenciar Usuários e Catálogo)</option>
                    <option value="admin">Administrador Master</option>
                </select>

                <label>Senha de Acesso</label>
                <input type="password" name="inputSenha" placeholder="Crie uma senha segura" required>

                <button type="submit">Cadastrar Moderador</button>

            </form>

        </div>
    </main>

</body>
</html>