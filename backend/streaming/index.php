<?php
include 'includes/conexao.php';
$result = $conn->query("SELECT * FROM filmes ORDER BY data_publicacao DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Meu Streaming</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Catálogo de Filmes</h1>
  <div class="catalogo" style="display: flex; flex-wrap: wrap; gap: 20px;">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="filme">
        <a href="video.php?id=<?php echo $row['id']; ?>">
          <img src="img_capas/<?php echo $row['thumbnail']; ?>" alt="<?php echo $row['titulo']; ?>" width="200" height="300">
          <h3><?php echo $row['titulo']; ?></h3>
        </a>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
