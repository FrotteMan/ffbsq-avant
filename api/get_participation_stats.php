<?php
require 'db_connect.php';

if (!isset($pdo)) {
    echo json_encode(['error' => '$pdo non défini']);
    exit();
}

$sql = "SELECT a.nom, a.prenom, COUNT(p.id_participation) AS nb_participations,
        (COUNT(p.id_participation) / 
         (SELECT COUNT(*) FROM competition)) * 100 AS taux_participation
        FROM adherents a
        LEFT JOIN participations p ON a.id_adherent = p.adherent_id
        GROUP BY a.id_adherent";

try {
    $stmt = $pdo->query($sql);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}
?>
