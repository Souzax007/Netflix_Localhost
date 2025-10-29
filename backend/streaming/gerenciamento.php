<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Filmes</title>
</head>
<body>
  <h2>Adicionar Filme</h2>
  <form action="includes/upload.php" method="POST" enctype="multipart/form-data">
    <label for="titulo">Título</label><br>
    <input type="text" id="titulo" name="titulo" required><br><br>

    <label for="descricao">Descrição</label><br>
    <textarea id="descricao" name="descricao" rows="4" cols="40" required></textarea><br><br>

    <label for="categoria">Categoria</label><br>
    <input type="text" id="categoria" name="categoria" required><br><br>

    <label for="capa">Capa</label><br>
    <input type="file" id="thumbnail" name="thumbnail" accept="image/*" required><br><br>

    <button type="submit">Salvar</button>
  </form>
</body>
</html>
