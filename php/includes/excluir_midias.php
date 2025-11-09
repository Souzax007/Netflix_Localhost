<?php
include "conexao.php";

$tipo = $_GET['tipo'] ?? '';
$id    = isset($_GET['id']) ? intval($_GET['id']) : null;
$arquivo = isset($_GET['arquivo']) ? basename($_GET['arquivo']) : null;

$diretorio_imagens = "../img_capas/";
$diretorio_videos  = "../videos/";

if ($tipo === 'imagem') {
    if ($id) {
        $sql = "SELECT thumbnail FROM filmes WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $caminho = $diretorio_imagens . $row['thumbnail'];
            if (file_exists($caminho)) unlink($caminho);
            $sql_delete = "DELETE FROM filmes WHERE id = ?";
            $stmt_del = $conn->prepare($sql_delete);
            $stmt_del->bind_param("i", $id);
            $stmt_del->execute();
        }
    } elseif ($arquivo) {
        $caminho = $diretorio_imagens . $arquivo;
        if (file_exists($caminho)) unlink($caminho);
    }
    echo "<script>window.location='../gerenciamento/gerenciar_midias.php';</script>";
    exit;
}

if ($tipo === 'video') {
    if ($id) {
        $sql = "SELECT arquivo FROM filmes WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $caminho = $diretorio_videos . $row['arquivo'];
            if (file_exists($caminho)) unlink($caminho);
            $sql_delete = "DELETE FROM filmes WHERE id = ?";
            $stmt_del = $conn->prepare($sql_delete);
            $stmt_del->bind_param("i", $id);
            $stmt_del->execute();
        }
    } elseif ($arquivo) {
        $caminho = $diretorio_videos . $arquivo;
        if (file_exists($caminho)) unlink($caminho);
    }
    echo "<script>window.location='../gerenciamento/gerenciar_midias.php';</script>";
    exit;
}

$conn->close();
?>
