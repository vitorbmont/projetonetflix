
<?php
$serie = $_GET['serie'] ?? 'A Última Fronteira';

$series = [
    "A Última Fronteira" => [
        "genero" => "Ficção científica",
        "ano" => "2026",
        "temporadas" => "1 temporada",
        "sinopse" => "Um grupo de sobreviventes precisa enfrentar perigos em um mundo desconhecido para encontrar um novo lar.",
        "episodios" => [
            "O Novo Mundo",
            "Primeiro Contato",
            "O Perigo se Aproxima",
            "A Última Esperança"
        ]
    ],

    "Cidade Sombria" => [
        "genero" => "Mistério",
        "ano" => "2025",
        "temporadas" => "1 temporada",
        "sinopse" => "Uma cidade esconde mistérios perigosos que começam a ser revelados.",
        "episodios" => [
            "O Desaparecimento",
            "Segredos da Cidade",
            "A Verdade"
        ]
    ],

    "Código Zero" => [
        "genero" => "Ação",
        "ano" => "2025",
        "temporadas" => "1 temporada",
        "sinopse" => "Um grupo de especialistas tenta impedir uma ameaça tecnológica.",
        "episodios" => [
            "O Início",
            "Sistema Invadido",
            "Missão Final"
        ]
    ],

    "Além do Tempo" => [
        "genero" => "Drama",
        "ano" => "2024",
        "temporadas" => "1 temporada",
        "sinopse" => "Uma viagem inesperada muda o destino de várias pessoas.",
        "episodios" => [
            "Uma Nova Chance",
            "O Passado",
            "O Futuro"
        ]
    ],

    "O Último Reino" => [
        "genero" => "Aventura",
        "ano" => "2025",
        "temporadas" => "1 temporada",
        "sinopse" => "Um guerreiro luta para proteger seu reino de seus inimigos.",
        "episodios" => [
            "O Herdeiro",
            "A Batalha",
            "O Último Reino"
        ]
    ]
];

if (!isset($series[$serie])) {
    $serie = "A Última Fronteira";
}

$dados = $series[$serie];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($serie); ?> - CinePlay</title>
    <link rel="stylesheet" href="css/maisSobreSerie.css">
    <link rel="stylesheet" href="css/principal.css">
</head>

<body>

    <header>
        <h1>CinePlay</h1>

        <nav>
            <a href="principal.php">Início</a>
            <a href="favoritos.php">Minha lista ★</a>
            <a href="login.php">Sair</a>
        </nav>
    </header>

    <main>

        <section class="informacoes">

            <h2><?php echo htmlspecialchars($serie); ?></h2>

            <p>
                <?php echo $dados['genero']; ?> |
                <?php echo $dados['ano']; ?> |
                <?php echo $dados['temporadas']; ?>
            </p>

            <h3>Sinopse</h3>

            <p><?php echo htmlspecialchars($dados['sinopse']); ?></p>

            <a href="adicionar_favorito.php?serie=<?php echo urlencode($serie); ?>">
                ★ Adicionar aos favoritos
            </a>

        </section>


        <section class="episodios">

            <h2>Lista de episódios</h2>

            <?php foreach ($dados['episodios'] as $indice => $episodio) { ?>

                <div class="episodio">

                    <h3>
                        Episódio <?php echo $indice + 1; ?>
                    </h3>

                    <p><?php echo htmlspecialchars($episodio); ?></p>

                </div>

            <?php } ?>

        </section>

        <a class="voltar" href="principal.php">
            Voltar ao catálogo
        </a>

    </main>

</body>
</html>
