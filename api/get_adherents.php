<?php
require 'db_connect.php';

if (!isset($pdo)) {
    echo json_encode(['error' => '$pdo non défini']);
    exit();
}

$sql = "SELECT a.nom_joueur, a.prenom_joueur, YEAR(CURDATE()) - YEAR(a.date_de_naissance_joueur) AS age,
        CASE 
            WHEN YEAR(CURDATE()) - YEAR(a.date_naissance) < 18 THEN 'U18'
            WHEN YEAR(CURDATE()) - YEAR(a.date_naissance) BETWEEN 18 AND 40 THEN 'Senior'
            ELSE 'Vétéran'
        END AS categorie_age,
        c.nom_club
        FROM joueur a
        JOIN club c ON a.club_id = c.id_club";

try {
    $stmt = $pdo->query($sql);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}
?>
