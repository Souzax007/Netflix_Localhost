<?php
  include 'php/includes/conexao.php';
  $result = $conn->query("SELECT * FROM filmes ORDER BY data_publicacao DESC");
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Navbar com Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary p-0 m-0 d-flex justify-content-between">
      <?php include 'php/includes/navbar.php'; ?>
    </nav>


    <script type="module" src="js/importar.js"></script>
    <script src="js/moveicon.js"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
