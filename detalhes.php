<?php

require_once __DIR__ . "/processamento/protegerUsuario.php";
require_once __DIR__ . "/processamento/funcoesBD.php";

$ehFilme = isset($_GET['filme']);

$titulo = $_GET['serie'] ?? $_GET['filme'] ?? $_GET['titulo'] ?? 'A Última Fronteira';

// Busca o conteúdo no banco
$conexao = conectarBD();

if ($ehFilme) {
    $sql = "SELECT * FROM filmes WHERE titulo = ?";
} else {
    $sql = "SELECT * FROM series WHERE titulo = ?";
}

$consulta = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($consulta, "s", $titulo);
mysqli_stmt_execute($consulta);

$resultado = mysqli_stmt_get_result($consulta);
$conteudo = mysqli_fetch_assoc($resultado);

mysqli_stmt_close($consulta);
mysqli_close($conexao);

// Sinopses dos conteúdos antigos (que não estão no banco)
$sinopses = [
    // Séries
    "A Última Fronteira" => "Um grupo de sobreviventes precisa enfrentar perigos em um mundo desconhecido para encontrar um novo lar.",
    "Cidade Sombria" => "Uma cidade esconde mistérios perigosos que começam a ser revelados.",
    "Código Zero" => "Um grupo de especialistas tenta impedir uma ameaça tecnológica.",
    "Além do Tempo" => "Uma viagem inesperada muda o destino de várias pessoas.",
    "O Último Reino" => "Um guerreiro luta para proteger seu reino de seus inimigos.",

    // Filmes
    "Resgate Implacável" => "Um agente especial precisa correr contra o tempo para salvar sua família de uma organização criminosa.",
    "Noite de Crime" => "Durante uma noite caótica, civis comuns precisam fazer de tudo para sobreviver às ruas perigosas.",
    "Fuga Alucinante" => "Um motorista de fuga se vê encurralado em um plano que deu totalmente errado."
];

if ($conteudo) {
    // Conteúdo cadastrado no banco
    $sinopse = $conteudo['sinopse'];
    $categoria = $conteudo['genero'] . " | Ano: " . $conteudo['ano_lancamento'] . " | Classificação: " . $conteudo['classificacao_indicativa'];
} else {
    // Conteúdo antigo (fixo no código)
    $sinopse = $sinopses[$titulo] ?? "Conheça essa produção e descubra uma história cheia de surpresas.";
    $categoria = "Catálogo | Entretenimento";
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Detalhes - FatecFlix</title>
    <link rel="stylesheet" href="css/detalhes.css">
</head>

<body>

    <header>
        <h1>FatecFlix</h1>

        <nav>
            <a href="principal.php">Início</a>
            <a href="favoritos.php">Minha lista ★</a>
            <a href="logout.php">Sair</a>
        </nav>
    </header>

    <main>

        <div class="detalhes">

            <h2><?php echo htmlspecialchars($titulo); ?></h2>

            <p class="categoria"><?php echo htmlspecialchars($categoria); ?></p>

            <h3>Sinopse</h3>

            <p><?php echo htmlspecialchars($sinopse); ?></p>

            <br>

            <a class="voltar" href="principal.php">
                Voltar ao catálogo
            </a>

        </div>

    </main>

</body>
</html>