<?php
$host = "localhost:3306";
$user = "root"; 
$pass = "";  
$db   = "quiz2_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8mb4");
?>
