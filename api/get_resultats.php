<?php
header('Content-Type: application/json');

if (!isset($_GET['competition_id'])) {
    echo json_encode(['message' => 'Paramètre competition_id manquant.']);
    exit;
}

$competition_id = intval($_GET['competition_id']);

$pdo = new PDO('mysql:host=172.29.103.63;dbname=ffbsq_competitions', 'root', '');

$sql = $pdo->prepare("
    SELECT r.id_resultat, e.nom_equipe, r.position, r.points
    FROM resultat r
    JOIN equipe e ON r.equipe_id = e.id_equipe
    WHERE r.competition_id = ?
    ORDER BY r.position ASC
");
$sql->execute([$competition_id]);

$resultats = $sql->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($resultats);

