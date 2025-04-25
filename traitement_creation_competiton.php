<?php
try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=172.29.103.63;dbname=ffbsq_competitions', 'root', '');


    // Récupération des données du formulaire
    $nom = $_POST['nom_competition'];
    $date = $_POST['date_competition'];
    $lieu = $_POST['lieu'];
    $categorie = $_POST['categorie_id'];
    $type = $_POST['type_id'];
    $nb_equipes = $_POST['nb_equipes'];
    $description = $_POST['description'];

    // Exécution de la procédure stockée (MySQL gère tout automatiquement)
    $sql = $pdo->prepare("CALL creer_competition(?, ?, ?, ?, ?, ?, ?)");
    $sql->execute([$nom, $date, $lieu, $categorie, $type, $nb_equipes, $description]);

    echo "Compétition créée avec succès ! <a href='creer_competition.php'>Retour</a>";

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>


