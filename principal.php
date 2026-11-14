<?php
$series = [
    [
        "nome" => "Cidade Sombria",
        "imagem" => "img/aaaa.jpg"
    ],
    [
        "nome" => "Código Zero",
        "imagem" => "img/cccc.jpg"
    ],
    [
        "nome" => "Além do Tempo",
        "imagem" => "img/xxx.jpg"
    ],
    [
        "nome" => "O Último Reino",
        "imagem" => "img/rrrr.jpg"
    ]
];

$filmes = [
    [
        "nome" => "Resgate Implacável",
        "imagem" => "img/Resgate_Implacavel.png"
    ],
    [
        "nome" => "Noite de Crime",
        "imagem" => "img/Noite_de_Crime.png"
    ],
    [
        "nome" => "Fuga Alucinante",
        "imagem" => "img/Fuga_Alucinante.png"
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>TipoNetflix</title>
    <link rel="stylesheet" href="css/principal.css">
</head>

<body>

    <header>
        <h1>TipoNetflix</h1>

        <nav>
            <a href="principal.php">Início</a>
            <a href="#secao-series">Séries</a>
            <a href="#secao-filmes">Filmes</a>
            <a href="favoritos.php">Minha lista ★</a>
            <a href="cadastrar.php" style="color: #e50914; font-weight: bold;">+ Cadastrar</a> <!-- Novo botão -->
            <a href="login.php">Sair</a>
        </nav>
    </header>

    <section class="destaque">
        <h2>A Última Fronteira</h2>

        <p>Ficção científica | 2026 | 1 temporada</p>

        <p>
            Em um mundo desconhecido, um grupo de sobreviventes
            precisa enfrentar perigos para encontrar um novo lar.
        </p>

        <a href="maisSobreSerie.php?serie=A Última Fronteira">
            <button>Assistir</button>
        </a>

        <a href="detalhes.php?serie=A Última Fronteira">
            <button>Mais informações</button>
        </a>
    </section>

    <main>
        <h2 id="secao-series">Outras séries</h2>

        <div class="catalogo">
            <?php foreach ($series as $serie) { ?>

                <div class="serie">
                    <img src="<?php echo $serie['imagem']; ?>" alt="<?php echo $serie['nome']; ?>">

                    <h3><?php echo $serie['nome']; ?></h3>

                    <a href="maisSobreSerie.php?serie=<?php echo urlencode($serie['nome']); ?>">
                        <button>Assistir</button>
                    </a>

                    <a href="detalhes.php?serie=<?php echo urlencode($serie['nome']); ?>">
                        <button>Mais informações</button>
                    </a>
                </div>

            <?php } ?>
        </div>

        <h2 id="secao-filmes">Filmes</h2>

        <div class="catalogo">
            <?php foreach ($filmes as $filme) { ?>

                <div class="serie">
                    <img src="<?php echo $filme['imagem']; ?>" alt="<?php echo $filme['nome']; ?>">

                    <h3><?php echo $filme['nome']; ?></h3>

                    <!-- CORRIGIDO: Agora aponta para maisSobreSerie.php com ?serie= -->
                    <a href="maisSobreSerie.php?serie=<?php echo urlencode($filme['nome']); ?>">
                        <button>Assistir</button>
                    </a>

                    <!-- CORRIGIDO: Agora aponta para detalhes.php com ?serie= -->
                    <a href="detalhes.php?serie=<?php echo urlencode($filme['nome']); ?>">
                        <button>Mais informações</button>
                    </a>
                </div>

            <?php } ?>
        </div>

    </main>

</body>
</html>