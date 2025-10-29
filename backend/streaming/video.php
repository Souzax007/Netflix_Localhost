<?php
include 'includes/conexao.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM filmes WHERE id = $id");
$filme = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $filme['titulo']; ?></title>
</head>
<body>
  <h1><?php echo $filme['titulo']; ?></h1>
  <video controls width="800">
    <source src="videos/<?php echo $filme['arquivo']; ?>" type="video/mp4">
  </video>
  <p><?php echo $filme['descricao']; ?></p>
</body>
</html>
