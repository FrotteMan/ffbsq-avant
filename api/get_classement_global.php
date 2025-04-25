<?php
require 'db_connect.php';

if (!isset($pdo)) {
    echo json_encode(['error' => '$pdo non défini']);
    exit();
}

$sql = "SELECT c.nom_club, SUM(r.points) AS total_points
        FROM resultat r
        JOIN equipe e ON r.equipe_id = e.id_equipe
        JOIN club c ON e.club_id = c.id_club
        GROUP BY c.nom_club
        ORDER BY total_points DESC";

try {
    $stmt = $pdo->query($sql);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit();  // ✅ Stoppe TOUT après l'envoi JSON
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit();  // ✅ Stoppe aussi en cas d’erreur
}
?>
