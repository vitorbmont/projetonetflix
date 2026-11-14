<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Conteúdo - TipoNetflix</title>
    <link rel="stylesheet" href="css/cadastrar_filmes_E_Series.css">
    <script>
        // Função em JavaScript para alternar os campos dependendo da escolha
        function alternarCampos() {
            var tipo = document.getElementById("tipoSelect").value;
            var camposFilme = document.getElementById("camposFilme");
            var camposSerie = document.getElementById("camposSerie");

            if (tipo === "filme") {
                camposFilme.style.display = "block";
                camposSerie.style.display = "none";
            } else {
                camposFilme.style.display = "none";
                camposSerie.style.display = "block";
            }
        }
    </script>
</head>
<body>

    <header>
        <h1>TipoNetflix</h1>
        <a href="principal.php">Voltar ao Início</a>
    </header>

    <main>
        <div class="cadastro" style="max-width: 500px; margin: auto;">
            
            <h2>Novo Cadastro</h2>
            <p>O que você deseja adicionar ao catálogo?</p>

            <form action="processarCadastro.php" method="POST">

                <!-- Escolha principal -->
                <label>Deseja cadastrar:</label>
                <select id="tipoSelect" name="tipo" onchange="alternarCampos()" required style="padding: 12px; margin-bottom: 18px; border: 1px solid #555; border-radius: 4px; background-color: #333; color: white; width: 100%;">
                    <option value="filme">Filme</option>
                    <option value="serie">Série</option>
                </select>

                <!-- Campos Comuns (Nome e Imagem que você já usa no projeto) -->
                <label>Título</label>
                <input type="text" name="titulo" placeholder="Ex: Resgate Implacável" required>

                <label>Caminho da Imagem (Capa)</label>
                <input type="text" name="imagem" placeholder="Ex: img/filme.png" required>

                <!-- CAMPO EXCLUSIVO DE FILME -->
                <div id="camposFilme">
                    <label>Duração do Filme</label>
                    <input type="text" name="duracao" placeholder="Ex: 2h 10m">
                </div>

                <!-- CAMPO EXCLUSIVO DE SÉRIE (Fica oculto por padrão até selecionar Série) -->
                <div id="camposSerie" style="display: none;">
                    <label>Quantidade de Temporadas</label>
                    <input type="number" name="temporadas" placeholder="Ex: 1">
                </div>

                <button type="submit">Salvar no Catálogo</button>

            </form>

        </div>
    </main>

</body>
</html>