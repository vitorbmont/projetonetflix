
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
            <a href="#">Séries</a>
            <a href="favoritos.php">Minha lista ★</a>
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

        <h2>Outras séries</h2>

        <?php foreach ($series as $serie) { ?>

            <div class="serie">

                <img src="<?php echo $serie['imagem']; ?>">

                <h3><?php echo $serie['nome']; ?></h3>

                <a href="maisSobreSerie.php?serie=<?php echo urlencode($serie['nome']); ?>">
                    <button>Assistir</button>
                </a>

                <a href="detalhes.php?serie=<?php echo urlencode($serie['nome']); ?>">
                    <button>Mais informações</button>
                </a>

            </div>

        <?php } ?>

    </main>

</body>
</html>
