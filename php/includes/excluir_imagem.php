<?php
include "conexao.php";

// Caminho da pasta
$diretorio = "../img_capas/";

if (isset($_GET['id'])) {
    // Excluir imagem que está no banco
    $id = intval($_GET['id']);

    $sql = "SELECT thumbnail FROM filmes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $arquivo = $diretorio . $row['thumbnail'];

        if (file_exists($arquivo)) {
            unlink($arquivo);
        }

        // Exclui o registro no banco
        $sql_delete = "DELETE FROM filmes WHERE id = ?";
        $stmt_del = $conn->prepare($sql_delete);
        $stmt_del->bind_param("i", $id);
        $stmt_del->execute();
    }

    echo "<script>alert('Imagem e registro excluídos com sucesso!'); window.location='../gereciamento/gerenciar_imagens.php';</script>";
}

// Caso seja uma imagem órfã (sem ID, apenas nome de arquivo)
if (isset($_GET['arquivo'])) {
    $arquivo = basename($_GET['arquivo']); // evita path traversal
    $caminho = $diretorio . $arquivo;

    if (file_exists($caminho)) {
        unlink($caminho);
        echo "<script>alert('Arquivo órfão excluído com sucesso!'); window.location='../gereciamento/gerenciar_imagens.php';</script>";
    } else {
        echo "<script>alert('Arquivo não encontrado.'); window.location='../gereciamento/gerenciar_imagens.php';</script>";
    }
}

$conn->close();
?>
