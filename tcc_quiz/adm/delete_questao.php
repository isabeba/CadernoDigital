<?php
include "db.php";
mysqli_set_charset($conn, "utf8mb4");

$id = $_GET['id'];
$conn->query("DELETE FROM alternativas WHERE id_questao = $id");
$conn->query("DELETE FROM questoes WHERE id_questao = $id");

header("Location: questoes.php");
