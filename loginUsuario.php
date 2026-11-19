<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - FatecFlix</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="formulario">
        <h2>Entrar no Usuario</h2>
    
        <form method="POST" action="../projetonetflix/processamento/processaUsuario.php">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>

            <?php if (isset($_GET['erro'])) { ?><p>E-mail ou senha incorretos!</p><?php } ?>
            <?php if (isset($_GET['senha'])) { ?><p>Senha atualizada! Faça login.</p><?php } ?>
            <?php if(isset($_GET['cadastro'])) { ?><p>Cadastro realizado! Faça login.</p><?php } ?>
            
            <button type="submit">ENTRAR</button>
        </form>
        
        <p><a href="redefinirsenha.php">Esqueci minha senha</a></p>
        <p><a href="cadastro.php">Criar conta</a></p>
    </div>
</body>
</html>