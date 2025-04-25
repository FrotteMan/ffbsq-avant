<?php
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'ffbsq_competitions';
$user = 'root';
$pass = '';  // Mets ton mot de passe si besoin

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Activer le mode exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur de connexion à la base : ' . $e->getMessage()]);
    exit();
}
?>

