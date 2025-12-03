<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode([]);
    exit();
}

$id_aluno = $_SESSION['id'];

require __DIR__ . '/../tcc_db.php';

$conn = $GLOBALS['conn'];

$sql = "SELECT titulo, data_evento, descricao 
        FROM eventos 
        WHERE (id_aluno = ? OR id_aluno IS NULL)
        ORDER BY data_evento ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_aluno);
$stmt->execute();
$result = $stmt->get_result();

$eventos = [];
while ($row = $result->fetch_assoc()) {
    $eventos[] = [
        "title" => $row["titulo"],
        "start" => $row["data_evento"],
        "description" => $row["descricao"]
    ];
}

echo json_encode($eventos);
?>
