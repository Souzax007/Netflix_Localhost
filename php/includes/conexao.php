<?php
$host = '10.1.7.11';
$user = 'marcos.souza';
$pass = 'M4rcos12007.';
$dbname = 'streaming';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
?>