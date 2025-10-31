<?php
include "../includes/conexao.php";

// Caminho da pasta onde ficam as imagens
$diretorio = "../img_capas/";

// Busca todas as imagens no banco
$sql = "SELECT id, titulo, thumbnail FROM filmes";
$result = $conn->query($sql);

$imagens_banco = [];
$dados_banco = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imagens_banco[] = $row['thumbnail'];
        $dados_banco[] = $row;
    }
}

// Lista todos os arquivos da pasta
$arquivos_pasta = array_diff(scandir($diretorio), array('.', '..'));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Imagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
<div class="container mt-4">
    <h2 class="mb-4">📁 Gerenciar Imagens</h2>

    <table class="table table-dark table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagem</th>
                <th>Origem</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($dados_banco)): ?>
            <?php foreach ($dados_banco as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['titulo']) ?></td>
                    <td><img src="../img_capas/<?= $row['thumbnail'] ?>" width="100"></td>
                    <td><span class="badge bg-success">Banco de Dados</span></td>
                    <td>
                        <a href="../includes/excluir_imagem.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Tem certeza que deseja excluir esta imagem e o registro do banco?');">
                           Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php
        // Exibir imagens órfãs (que estão na pasta, mas não no banco)
        $orfas = array_diff($arquivos_pasta, $imagens_banco);
        if (!empty($orfas)):
            foreach ($orfas as $arquivo):
        ?>
                <tr>
                    <td>-</td>
                    <td><i>Sem registro</i></td>
                    <td><img src="../img_capas/<?= $arquivo ?>" width="100"></td>
                    <td><span class="badge bg-warning text-dark">Apenas na pasta</span></td>
                    <td>
                        <a href="../includes/excluir_imagem.php?arquivo=<?= urlencode($arquivo) ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Tem certeza que deseja excluir apenas o arquivo da pasta?');">
                           Excluir
                        </a>
                    </td>
                </tr>
        <?php
            endforeach;
        endif;
        ?>

        <?php if (empty($dados_banco) && empty($orfas)): ?>
            <tr><td colspan="5" class="text-center">Nenhuma imagem encontrada</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php $conn->close(); ?>
