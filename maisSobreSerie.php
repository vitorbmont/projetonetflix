<?php
$titulo = $_GET['titulo'] ?? $_GET['serie'] ?? $_GET['filme'] ?? 'A Última Fronteira';

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

// Lista de filmes para identificar se o título atual é um filme
$listaFilmes = ["Resgate Implacável", "Noite de Crime", "Fuga Alucinante"];
$ehFilme = in_array($titulo, $listaFilmes);

if ($ehFilme) {
    // Se for filme, exibe apenas a faixa do longa-metragem
    $conteudos = [
        ["titulo" => "Filme Completo: " . $titulo, "duracao" => "2h 10m", "progresso" => "45%"]
    ];
} else {
    // Se for série, exibe os episódios com a barra de progresso
    $conteudos = [
        ["titulo" => "Episódio 1: O Começo", "duracao" => "45m", "progresso" => "85%"],
        ["titulo" => "Episódio 2: Novos Rumos", "duracao" => "50m", "progresso" => "30%"],
        ["titulo" => "Episódio 3: Consequências", "duracao" => "42m", "progresso" => "0%"],
    ];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Assistir <?php echo htmlspecialchars($titulo); ?> - TipoNetflix</title>
    <link rel="stylesheet" href="css/maisSobreSerie.css">
</head>
<body>

    <header>
        <h1>TipoNetflix</h1>
        <nav>
            <a href="principal.php">Início</a>
            <a href="favoritos.php">Minha lista ★</a>
            <a href="login.php">Sair</a>
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

            <div class="lista-episodios">
                <h3><?php echo $ehFilme ? "Reprodução" : "Episódios"; ?></h3>
                
                <?php foreach ($conteudos as $item) { ?>
                    <div class="episodio-card">
                        <div class="episodio-info">
                            <strong><?php echo $item['titulo']; ?></strong>
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