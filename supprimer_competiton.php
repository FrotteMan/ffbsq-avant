<?php
$pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'root', '');

if (!isset($_GET['id'])) {
    die("ID de compétition manquant.");
}

$id = $_GET['id'];

// Supprimer la compétition
$sql = $pdo->prepare("DELETE FROM competition WHERE id_competition = ?");
$sql->execute([$id]);

echo " Compétition supprimée avec succès ! <a href='gestion_competitions.php'>Retour</a>";
?>
