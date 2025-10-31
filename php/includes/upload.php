<?php
include "conexao.php";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $categoria = $_POST["categoria"];

    // Pasta onde as capas serão armazenadas (fora de includes/)
    $diretorio = "../img_capas/";

    // Cria a pasta se não existir
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    // Pega o nome do arquivo
    $arquivo_nome = basename($_FILES["thumbnail"]["name"]);
    $novo_nome = uniqid() . "_" . $arquivo_nome;
    $caminho_arquivo = $diretorio . $novo_nome;

    //aqui, apenas o nome do arquivo será salvo no banco
    $nome_no_banco = $novo_nome;

    if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $caminho_arquivo)) {
        // Inserir no banco
        $sql = "INSERT INTO filmes (titulo, descricao, categoria, thumbnail) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssis", $titulo, $descricao, $categoria, $nome_no_banco);

        if ($stmt->execute()) {
            echo "Filme salvo com sucesso!";
        } else {
            echo "Erro ao salvar no banco: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro ao fazer upload da capa.";
    }
}

$conn->close();
?>
