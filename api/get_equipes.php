<?php
header('Content-Type: application/json');

$pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'root', 'root');

$sql = $pdo->query("
    SELECT e.id_equipe, e.nom_equipe, c.nom_club
    FROM equipe e
    JOIN club c ON e.club_id = c.id_club
    ORDER BY e.nom_equipe ASC
");

$equipes = $sql->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($equipes);

