<?php 
    include "../includes/conexao.php";

      $sql = "SELECT id, nome FROM categorias ORDER BY nome";
      $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Filmes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../css/nav.css">  
</head>
<body>
 <nav class="navbar navbar-expand-lg bg-body-tertiary p-0 m-0 d-flex justify-content-between">
      <?php include '../includes/navbar.php'; ?>
  </nav>

  <h2>Adicionar mais uma categoria à lista</h2>
  <form action="../includes/adicionar_categoria.php" method="post">
    <label for="nome">Nova Categoria:</label>
    <input type="text" id="nome" name="nome">
    <button type="submit">Adicionar</button>
  </form>

  <h2>Adicionar Filme</h2>
  <form action="../includes/upload.php" method="POST" enctype="multipart/form-data">
    <label for="titulo">Título</label><br>
    <input type="text" id="titulo" name="titulo" required><br><br>

    <label for="descricao">Descrição</label><br>
    <textarea id="descricao" name="descricao" rows="4" cols="40" required></textarea><br><br>

    <label for="categoria">Categoria:</label>
    <select id="categoria" name="categoria" required>
      <option value="">Selecione...</option>
      <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['nome']}</option>";
            }
        }
      ?>
    </select>
    <br><br>

    <label for="thumbnail">Capa</label><br>
    <input type="file" id="thumbnail" name="thumbnail" accept="image/*" required><br><br>

    <button type="submit">Salvar</button>
  </form>

  <script type="module" src="../../js/importar.js"></script>
  <script src="../../js/moveicon.js"></script>
  <script src="https://cdn.lordicon.com/lordicon.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
