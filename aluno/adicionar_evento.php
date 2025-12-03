<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['id'])) {
    http_response_code(403);
    echo json_encode(["erro" => "Não autorizado"]);
    exit();
}

$id_aluno = $_SESSION['id'];
$data = json_decode(file_get_contents("php://input"), true);

require __DIR__ . '/../tcc_db.php';

$conn = $GLOBALS['sql'];

$sql = "INSERT INTO eventos (titulo, data_evento, descricao, id_aluno) 
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $data['titulo'], $data['data_evento'], $data['descricao'], $id_aluno);
$stmt->execute();

echo json_encode(["ok" => true]);
?>
