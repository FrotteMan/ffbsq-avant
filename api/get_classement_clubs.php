<?php
header('Content-Type: application/json');

$pdo = new PDO('mysql:host=172.29.103.63;dbname=ffbsq_competitions', 'root', '');

$sql = $pdo->query("
    SELECT c.nom_club, SUM(r.points) AS total_points
    FROM resultat r
    JOIN equipe e ON r.equipe_id = e.id_equipe
    JOIN club c ON e.club_id = c.id_club
    GROUP BY c.id_club
    ORDER BY total_points DESC
");

$classement = $sql->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($classement);

