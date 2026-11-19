<?php
session_start();

if (!isset($_SESSION['id_moderador'])) {
    header("Location: loginModerador.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Conteúdo - FatecFlix</title>
    <link rel="stylesheet" href="css/cadastrar_filmes_E_Series.css">
</head>

<body>

<header>
    <h1>FatecFlix</h1>
    <nav>
        <a href="listaUsuarios.php">Usuários cadastrados</a>
        <a href="logout.php">Sair</a>
    </nav>
</header>

<main>
    <div class="cadastro">

        <h2>Novo Cadastro</h2>
        <p>O que você deseja adicionar ao catálogo?</p>

        <form action="processamento/processarFilmeSerie.php"
      method="POST"
      enctype="multipart/form-data">

            <label>Tipo de conteúdo</label>
            <select name="tipo" id="tipoSelect" onchange="alternarCampos()">
                <option value="filme">Filme</option>
                <option value="serie">Série</option>
            </select>

            <label>Título</label>
            <input type="text" name="titulo" required>

            <label>Sinopse</label>
            <textarea name="sinopse" required></textarea>

            <label>Gênero</label>
            <input type="text" name="genero" required>

            <label>Ano de lançamento</label>
            <input type="number" name="ano" min="1901" required>

            <label>Classificação indicativa</label>
            <input type="text" name="classificacao"
                   placeholder="Ex: 16 anos" required>

            <label>Capa</label>
            <input type="file" name="imagem"
                   accept="image/png, image/jpeg, image/webp" required>

            <div id="camposFilme">
                <label>Duração (minutos)</label>
                <input type="number" name="duracao"
                       id="duracao" min="1" required>
            </div>

            <div id="camposSerie" hidden>
                <label>Quantidade de episódios</label>
                <input type="number" name="episodios"
                       id="episodios" min="1">
            </div>

            <button type="submit">Salvar no Catálogo</button>

        </form>
    </div>
</main>

<script>
    function alternarCampos() {
        const tipo = document.getElementById("tipoSelect").value;

        const camposFilme = document.getElementById("camposFilme");
        const camposSerie = document.getElementById("camposSerie");

        const duracao = document.getElementById("duracao");
        const episodios = document.getElementById("episodios");

        camposFilme.hidden = tipo !== "filme";
        camposSerie.hidden = tipo !== "serie";

        duracao.required = tipo === "filme";
        episodios.required = tipo === "serie";
    }

    alternarCampos();
</script>

</body>
</html>