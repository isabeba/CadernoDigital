<?php
$host = "localhost:3306";
$user = "root"; // altere se necessário
$pass = "";     // senha do MySQL
$db   = "quiz_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
