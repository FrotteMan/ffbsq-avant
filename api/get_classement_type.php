<?php
require 'db_connect.php';

if (!isset($pdo)) {
    echo json_encode(['error' => '$pdo non défini']);
    exit();
}

$sql = "SELECT c.type_competition, SUM(r.points) AS total_points
        FROM resultat r
        JOIN competition c ON r.competition_id = c.id_competition
        GROUP BY c.type_competition
        ORDER BY total_points DESC";

try {
    $stmt = $pdo->query($sql);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}
?>
