<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['message' => 'Méthode non autorisée.']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['competition_id'], $data['equipe_id'], $data['position'])) {
    echo json_encode(['message' => 'Données manquantes.']);
    exit;
}

$competition_id = $data['competition_id'];
$equipe_id = $data['equipe_id'];
$position = $data['position'];

try {
    $pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'root', 'root');
    $stmt = $pdo->prepare("CALL ajouter_resultat(?, ?, ?)");
    $stmt->execute([$competition_id, $equipe_id, $position]);

    echo json_encode(['message' => 'Résultat ajouté.']);
} catch (PDOException $e) {
    echo json_encode(['message' => 'Erreur : ' . $e->getMessage()]);
}

