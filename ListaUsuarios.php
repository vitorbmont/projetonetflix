<?php

// Somente moderador logado acessa esta tela
require_once __DIR__ . "/processamento/protegerModerarador.php";
require_once __DIR__ . "/processamento/funcoesBD.php";

$usuarios = consultarUsuarios();
$total = count($usuarios);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários cadastrados - FatecFlix</title>

    <link rel="stylesheet" href="css/cadastrar_filmes_E_Series.css">
</head>

<body>

    <header>
        <h1>FatecFlix</h1>

        <nav>
            <a href="cadastrar_filmes_E_Series.php" style="color: #e50914; font-weight: bold;">+ Cadastrar conteúdo</a>
            <a href="logout.php">Sair</a>
        </nav>
    </header>

    <main>

        <div class="cadastro larga">

            <h2>Usuários cadastrados</h2>
            <p>Total de usuários: <?php echo $total; ?></p>

            <?php if ($total == 0) { ?>

                <p>Nenhum usuário cadastrado ainda.</p>

            <?php } else { ?>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Nascimento</th>
                            <th>Cadastrado em</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($usuarios as $usuario) { ?>
                            <tr>
                                <td><?php echo (int)$usuario['id']; ?></td>
                                <td><?php echo htmlspecialchars($usuario['nome'] . " " . $usuario['sobrenome']); ?></td>
                                <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($usuario['data_nascimento'])); ?></td>
                                <td><?php echo date("d/m/Y H:i", strtotime($usuario['data_cadastro'])); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            <?php } ?>

        </div>

    </main>

</body>
</html>