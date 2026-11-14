<?php
// Pega o nome do filme ou série de qualquer um dos parâmetros possíveis da URL
$titulo = $_GET['serie'] ?? $_GET['filme'] ?? $_GET['titulo'] ?? 'A Última Fronteira';

// Dicionário unificado de sinopses (séries e filmes)
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

$sinopse = $sinopses[$titulo] ?? "Conheça essa produção e descubra uma história cheia de surpresas.";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Detalhes - TipoNetflix</title>
    <link rel="stylesheet" href="css/detalhes.css">
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

            <h2><?php echo htmlspecialchars($titulo); ?></h2>

            <p class="categoria">Catálogo | Entretenimento</p>

            <h3>Sinopse</h3>

            <p><?php echo htmlspecialchars($sinopse); ?></p>

            <a class="favorito" href="adicionar_favorito.php?titulo=<?php echo urlencode($titulo); ?>">
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