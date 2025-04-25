<?php
header('Content-Type: application/json');

$pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'root', 'root');
$sql = $pdo->query("
    SELECT id_competition, nom_competition, date_competition, lieu
    FROM competition
    ORDER BY date_competition DESC
");

$competitions = $sql->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($competitions);

