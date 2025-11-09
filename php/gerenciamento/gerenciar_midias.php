<?php
include "../includes/conexao.php";

// Pastas
$diretorio_imagens = "../img_capas/";
$diretorio_videos  = "../videos/";

// BUSCA NO BANCO
$sql = "SELECT id, titulo, thumbnail, arquivo FROM filmes";
$result = $conn->query($sql);

$dados_banco = [];
$imagens_banco = [];
$videos_banco  = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dados_banco[] = $row;
        if (!empty($row['thumbnail'])) $imagens_banco[] = $row['thumbnail'];
        if (!empty($row['arquivo']))    $videos_banco[]  = $row['arquivo'];
    }
}

// LISTA OS ARQUIVOS DAS PASTAS
$arquivos_imagens = array_diff(scandir($diretorio_imagens), array('.', '..'));
$arquivos_videos  = array_diff(scandir($diretorio_videos), array('.', '..'));

// NORMALIZA PARA COMPARAÇÃO
$arquivos_imagens_normal = array_map('strtolower', $arquivos_imagens);
$arquivos_videos_normal  = array_map('strtolower', $arquivos_videos);
$imagens_banco_normal    = array_map('strtolower', $imagens_banco);
$videos_banco_normal     = array_map('strtolower', $videos_banco);

// IDENTIFICA ÓRFÃS
$imagens_orfas = array_diff($arquivos_imagens_normal, $imagens_banco_normal);
$videos_orfas  = array_diff($arquivos_videos_normal, $videos_banco_normal);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Mídias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/nav.css"> 
</head>
<body class="bg-dark text-light">
  <nav class="navbar navbar-expand-lg bg-body-tertiary p-0 m-0 d-flex justify-content-between">
      <?php include '../includes/navbar.php'; ?>
  </nav>

<div class="container mt-4">

    <h2 class="mb-3"> Imagens</h2>
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
        <?php foreach ($dados_banco as $row): ?>
            <?php if (!empty($row['thumbnail'])): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['titulo']) ?></td>
                    <td><img src="../img_capas/<?= htmlspecialchars($row['thumbnail']) ?>" width="100"></td>
                    <td><span class="badge bg-success">Banco de Dados</span></td>
                    <td>
                        <a href="../includes/excluir_midias.php?tipo=imagem&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Excluir imagem e registro do banco?');">Excluir</a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php foreach ($imagens_orfas as $nome_normalizado):
            $nome_real = $arquivos_imagens[array_search($nome_normalizado, $arquivos_imagens_normal)];
        ?>
            <tr>
                <td>-</td>
                <td><i>Sem registro</i></td>
                <td><img src="../img_capas/<?= htmlspecialchars($nome_real) ?>" width="100"></td>
                <td><span class="badge bg-warning text-dark">Apenas na pasta</span></td>
                <td>
                    <a href="../includes/excluir_midias.php?tipo=imagem&arquivo=<?= urlencode($nome_real) ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Excluir apenas arquivo da pasta?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="mb-3 mt-5"> Vídeos</h2>
    <table class="table table-dark table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Arquivo</th>
                <th>Origem</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($dados_banco as $row): ?>
            <?php if (!empty($row['arquivo'])): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['titulo']) ?></td>
                    <td><?= htmlspecialchars($row['arquivo']) ?></td>
                    <td><span class="badge bg-success">Banco de Dados</span></td>
                    <td>
                        <a href="../includes/excluir_midias.php?tipo=video&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Excluir vídeo e registro do banco?');">Excluir</a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php foreach ($videos_orfas as $nome_normalizado):
            $nome_real = $arquivos_videos[array_search($nome_normalizado, $arquivos_videos_normal)];
        ?>
            <tr>
                <td>-</td>
                <td><i>Sem registro</i></td>
                <td><?= htmlspecialchars($nome_real) ?></td>
                <td><span class="badge bg-warning text-dark">Apenas na pasta</span></td>
                <td>
                    <a href="../includes/excluir_midias.php?tipo=video&arquivo=<?= urlencode($nome_real) ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Excluir apenas arquivo da pasta?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

 <script type="module" src="../../js/importar.js"></script>
  <script src="../../js/moveicon.js"></script>
  <script src="https://cdn.lordicon.com/lordicon.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
