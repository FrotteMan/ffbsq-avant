<?php
require 'db_connect.php';

if (!isset($pdo)) {
    echo json_encode(['error' => '$pdo non défini']);
    exit();
}

$sql = "SELECT a.nom, a.prenom, YEAR(CURDATE()) - YEAR(a.date_naissance) AS age,
        CASE 
            WHEN YEAR(CURDATE()) - YEAR(a.date_naissance) < 18 THEN 'U18'
            WHEN YEAR(CURDATE()) - YEAR(a.date_naissance) BETWEEN 18 AND 40 THEN 'Senior'
            ELSE 'Vétéran'
        END AS categorie_age,
        SUM(r.points) AS total_points
        FROM adherents a
        JOIN participations p ON a.id_adherent = p.adherent_id
        JOIN competition c ON p.competition_id = c.id_competition
        JOIN equipe e ON e.club_id = a.club_id
        JOIN resultat r ON r.equipe_id = e.id_equipe AND r.competition_id = c.id_competition
        GROUP BY a.id_adherent
        ORDER BY total_points DESC";

try {
    $stmt = $pdo->query($sql);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}
?>
