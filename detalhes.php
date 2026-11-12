
<?php
$serie = $_GET['serie'] ?? 'A Última Fronteira';

$sinopses = [
    "A Última Fronteira" => "Um grupo de sobreviventes precisa enfrentar perigos em um mundo desconhecido para encontrar um novo lar.",
    "Cidade Sombria" => "Uma cidade esconde mistérios perigosos que começam a ser revelados.",
    "Código Zero" => "Um grupo de especialistas tenta impedir uma ameaça tecnológica.",
    "Além do Tempo" => "Uma viagem inesperada muda o destino de várias pessoas.",
    "O Último Reino" => "Um guerreiro luta para proteger seu reino de seus inimigos."
];

$sinopse = $sinopses[$serie] ?? "Conheça essa série e descubra uma história cheia de surpresas.";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Detalhes - CinePlay</title>
    <link rel="stylesheet" href="css/detalhes.css">
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

        <div class="detalhes">

            <h2><?php echo htmlspecialchars($serie); ?></h2>

            <p class="categoria">Série | Ficção e entretenimento</p>

            <h3>Sinopse</h3>

            <p><?php echo htmlspecialchars($sinopse); ?></p>

            <a class="favorito" href="adicionar_favorito.php?serie=<?php echo urlencode($serie); ?>">
                ★ Adicionar aos favoritos
            </a>

            <br><br>

            <a class="voltar" href="principal.php">
                Voltar ao catálogo
            </a>

        </div>

    </main>

</body>
</html>
