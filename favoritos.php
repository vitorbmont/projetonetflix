<?php

session_start();

require_once __DIR__ . "/processamento/funcoesBD.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: loginUsuario.php");
    exit;
}

$favoritos = consultarFavoritos((int)$_SESSION['usuario_id']);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minha lista - FatecFlix</title>
    <link rel="stylesheet" href="css/principal.css">
</head>
<body>

    <header>
        <h1>FatecFlix</h1>
        <nav>
            <a href="principal.php">Início</a>
            <a href="favoritos.php">Minha lista ★</a>
            <a href="loginUsuario.php">Sair</a>
        </nav>
    </header>

    <main>
        <h2>Minha lista ★</h2>

<?php if (empty($favoritos)) { ?>
    <p>Você ainda não adicionou nada aos favoritos.</p>
<?php } ?>

<div class="catalogo grade">
    <?php foreach ($favoritos as $item) { ?>
        <?php $parametro = $item['tipo'] == 'filme' ? 'filme' : 'serie'; ?>
        <div class="serie">
            <img src="img/<?php echo htmlspecialchars($item['capa']); ?>"
                 alt="<?php echo htmlspecialchars($item['titulo']); ?>">
            <h3><?php echo htmlspecialchars($item['titulo']); ?></h3>
            <a href="maisSobreSerie.php?<?php echo $parametro; ?>=<?php echo urlencode($item['titulo']); ?>">
                <button>Assistir</button>
            </a>
        </div>
    <?php } ?>
</div>
    </main>

</body>
</html>