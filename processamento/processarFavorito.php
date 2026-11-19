<?php

session_start();

require_once __DIR__ . "/funcoesBD.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die("Acesso inválido!");
}

// Precisa estar logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../loginUsuario.php");
    exit;
}

$usuarioId = (int)$_SESSION['usuario_id'];
$tipo = $_POST['tipo'] ?? '';
$conteudoId = (int)($_POST['conteudo_id'] ?? 0);

if (($tipo != 'filme' && $tipo != 'serie') || $conteudoId < 1) {
    die("Dados inválidos!");
}

if (verificarFavorito($usuarioId, $tipo, $conteudoId)) {
    removerFavorito($usuarioId, $tipo, $conteudoId);
} else {
    adicionarFavorito($usuarioId, $tipo, $conteudoId);
}

// Volta para a página de onde veio
$volta = $_SERVER['HTTP_REFERER'] ?? "../principal.php";
header("Location: " . $volta);
exit;