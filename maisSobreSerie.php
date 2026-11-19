<?php

require_once __DIR__ . "/processamento/protegerUsuario.php";
require_once __DIR__ . "/processamento/funcoesBD.php";

// Identifica se recebeu filme ou série
$ehFilme = isset($_GET['filme']);

$titulo = $_GET['filme'] ?? $_GET['serie'] ?? $_GET['titulo'] ?? 'A Última Fronteira';

$sinopse = "";
$conteudos = [];

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

// Estado do favorito (só existe para conteúdos que estão no banco)
$podeFavoritar = false;
$ehFavorito = false;
$tipoConteudo = $ehFilme ? 'filme' : 'serie';

if ($conteudo && isset($_SESSION['usuario_id'])) {
    $podeFavoritar = true;
    $ehFavorito = verificarFavorito($_SESSION['usuario_id'], $tipoConteudo, $conteudo['id']);
}

// Avaliação (só para conteúdos que estão no banco)
$mediaAvaliacao = null;
$totalAvaliacoes = 0;
$minhaNota = 0;

if ($conteudo) {
    $dadosAvaliacao = consultarMediaAvaliacao($tipoConteudo, $conteudo['id']);
    $mediaAvaliacao = $dadosAvaliacao['media'];
    $totalAvaliacoes = $dadosAvaliacao['total'];
    $minhaNota = consultarNotaUsuario($_SESSION['usuario_id'], $tipoConteudo, $conteudo['id']);
}

// Se não encontrar no banco, utiliza os conteúdos antigos
if ($conteudo) {

    $sinopse = $conteudo['sinopse'];

    if ($ehFilme) {

        $conteudos = [
            [
                "titulo" => "Filme Completo: " . $titulo,
                "duracao" => $conteudo['duracao'] . " minutos",
                "progresso" => "0%"
            ]
        ];

    } else {

        // Busca os episódios da série na tabela episodios
        $episodios = consultarEpisodios($conteudo['id']);

        foreach ($episodios as $ep) {
            $conteudos[] = [
                "titulo" => $ep['titulo'],
                "duracao" => $ep['duracao'] . "m",
                "progresso" => "0%"
            ];
        }

        // Séries cadastradas antes da tabela de episódios: mostra a linha antiga
        if (empty($conteudos)) {
            $conteudos = [
                [
                    "titulo" => "Série: " . $titulo,
                    "duracao" => $conteudo['qtd_episodios'] . " episódios",
                    "progresso" => "0%"
                ]
            ];
        }

    }

} else {

    $sinopses = [
        "A Última Fronteira" => "Um grupo de sobreviventes precisa enfrentar perigos em um mundo desconhecido para encontrar um novo lar.",
        "Cidade Sombria" => "Uma cidade esconde mistérios perigosos que começam a ser revelados.",
        "Código Zero" => "Um grupo de especialistas tenta impedir uma ameaça tecnológica.",
        "Além do Tempo" => "Uma viagem inesperada muda o destino de várias pessoas.",
        "O Último Reino" => "Um guerreiro luta para proteger seu reino de seus inimigos.",
        "Resgate Implacável" => "Um agente especial precisa correr contra o tempo para salvar sua família de uma organização criminosa.",
        "Noite de Crime" => "Durante uma noite caótica, civis comuns precisam fazer de tudo para sobreviver às ruas perigosas.",
        "Fuga Alucinante" => "Um motorista de fuga se vê encurralado em um plano que deu totalmente errado."
    ];

    $sinopse = $sinopses[$titulo] ?? "Assista agora a este incrível conteúdo em alta definição.";

    if ($ehFilme) {

        $conteudos = [
            ["titulo" => "Filme Completo: " . $titulo, "duracao" => "2h 10m", "progresso" => "45%"]
        ];

    } else {

        $conteudos = [
            ["titulo" => "Episódio 1: O Começo", "duracao" => "45m", "progresso" => "85%"],
            ["titulo" => "Episódio 2: Novos Rumos", "duracao" => "50m", "progresso" => "30%"],
            ["titulo" => "Episódio 3: Consequências", "duracao" => "42m", "progresso" => "0%"]
        ];

    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Assistir <?php echo htmlspecialchars($titulo); ?> - FatecFlix</title>
    <link rel="stylesheet" href="css/maisSobreSerie.css">
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

            <div class="player-container">
                <h2>▶ Reproduzindo: <?php echo htmlspecialchars($titulo); ?></h2>
            </div>

            <h2><?php echo htmlspecialchars($titulo); ?></h2>
            <p class="categoria"><?php echo $ehFilme ? "Filme | Longa-metragem" : "Série | Episódios"; ?></p>

            <h3 style="margin-top: 15px;">Sinopse</h3>
            <p><?php echo htmlspecialchars($sinopse); ?></p>

            <?php if ($podeFavoritar) { ?>
                <form action="processamento/processarFavorito.php" method="POST">
                    <input type="hidden" name="tipo" value="<?php echo $tipoConteudo; ?>">
                    <input type="hidden" name="conteudo_id" value="<?php echo $conteudo['id']; ?>">
                    <button type="submit" class="favorito <?php echo $ehFavorito ? 'ativo' : ''; ?>">
                        <?php echo $ehFavorito ? "★ Remover dos favoritos" : "☆ Adicionar aos favoritos"; ?>
                    </button>
                </form>
            <?php } ?>

            <?php if ($conteudo) { ?>
                <div class="avaliacao">

                    <p>
                        <?php if ($mediaAvaliacao !== null) { ?>
                            ★ <?php echo $mediaAvaliacao; ?> / 5
                            (<?php echo $totalAvaliacoes; ?> <?php echo $totalAvaliacoes == 1 ? "avaliação" : "avaliações"; ?>)
                        <?php } else { ?>
                            Ainda sem avaliações.
                        <?php } ?>
                    </p>

                    <form action="processamento/processarAvaliacao.php" method="POST">
                        <input type="hidden" name="tipo" value="<?php echo $tipoConteudo; ?>">
                        <input type="hidden" name="conteudo_id" value="<?php echo $conteudo['id']; ?>">

                        <label for="nota">Sua nota:</label>
                        <select name="nota" id="nota" required>
                            <option value="">Escolha</option>
                            <?php for ($i = 1; $i <= 5; $i++) { ?>
                                <option value="<?php echo $i; ?>" <?php echo $minhaNota == $i ? "selected" : ""; ?>>
                                    <?php echo str_repeat("★", $i) . " ($i)"; ?>
                                </option>
                            <?php } ?>
                        </select>

                        <button type="submit"><?php echo $minhaNota ? "Atualizar nota" : "Avaliar"; ?></button>
                    </form>

                </div>
            <?php } ?>

            <div class="lista-episodios">
                <h3><?php echo $ehFilme ? "Reprodução" : "Episódios"; ?></h3>

                <?php foreach ($conteudos as $item) { ?>
                    <div class="episodio-card">
                        <div class="episodio-info">
                            <strong><?php echo htmlspecialchars($item['titulo']); ?></strong>
                            <span><?php echo $item['duracao']; ?></span>
                        </div>

                        <!-- Layer / Barra de Progresso estilo Netflix -->
                        <div class="netflix-progress-bar" title="Progresso: <?php echo $item['progresso']; ?>">
                            <div class="netflix-progress-fill" style="width: <?php echo $item['progresso']; ?>;"></div>
                        </div>
                    </div>
                <?php } ?>

            </div>

            <br>
            <a class="voltar" href="principal.php">← Voltar ao catálogo</a>
        </div>
    </main>

</body>
</html>