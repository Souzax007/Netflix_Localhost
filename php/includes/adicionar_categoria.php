<?php
    include "conexao.php";
    // Pega o valor do formulário
if(isset($_POST['nome'])) {
    $nome = $conn->real_escape_string($_POST['nome']);

    // Insere no banco
    $sql = "INSERT INTO categorias (nome) VALUES ('$nome')";

    if ($conn->query($sql) === TRUE) {
        echo "Categoria adicionada com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}

?>
