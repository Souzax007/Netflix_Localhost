<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $categoria = $_POST["categoria"];

    $dir_capas = "../img_capas/";

    if (!is_dir($dir_capas)) mkdir($dir_capas, 0777, true);

    $nome_capa = uniqid() . "_" . basename($_FILES["thumbnail"]["name"]);
    $caminho_capa = $dir_capas . $nome_capa;


    if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $caminho_capa)) {

        $sql = "INSERT INTO filmes (titulo, descricao, categoria, thumbnail)
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssis", $titulo, $descricao, $categoria, $nome_capa);
        
        if ($stmt->execute()) {
            echo "Filme enviado e salvo com sucesso!";
        } else {
            echo "Erro ao salvar no banco: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Erro ao mover arquivos.";
    }
}
$conn->close();
?>
