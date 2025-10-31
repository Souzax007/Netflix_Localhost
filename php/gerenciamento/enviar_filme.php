
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
</head>
<body>
  <h2>Adicionar mais uma categoria a lista</h2>
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

    <label for="capa">Capa</label><br>
    <input type="file" id="thumbnail" name="thumbnail" accept="image/*" required><br><br>

    <button type="submit">Salvar</button>
  </form>
</body>
</html>
