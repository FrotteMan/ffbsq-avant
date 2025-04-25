<?php
echo '<link rel="stylesheet" type="text/css" href="style.css">';
include 'menu.php';
$pdo = new PDO('mysql:host=172.29.103.63;dbname=ffbsq_competitions', 'root', '');


$sql = $pdo->query("
SELECT
    c.nom_competition,
    c.date_competition,
    c.lieu,
    cat.nom_categorie,
    t.nom_type,
    c.nb_equipes,
    gp.type_grille,
    c.description
FROM competition c
JOIN categorie cat ON c.categorie_id = cat.id_categorie
JOIN type_competition t ON c.type_id = t.id_type
JOIN grille_points gp ON c.grille_id = gp.id_grille
ORDER BY c.date_competition DESC
");

echo "<h2>Liste complète des compétitions</h2><table border='1'>";
echo "<tr><th>Nom</th><th>Date</th><th>Lieu</th><th>Catégorie</th><th>Type</th><th>Nb équipes</th><th>Grille</th><th>Description</th></tr>";

while ($row = $sql->fetch()) {
    echo "<tr>
        <td>{$row['nom_competition']}</td>
        <td>{$row['date_competition']}</td>
        <td>{$row['lieu']}</td>
        <td>{$row['nom_categorie']}</td>
        <td>{$row['nom_type']}</td>
        <td>{$row['nb_equipes']}</td>
        <td>{$row['type_grille']}</td>
        <td>{$row['description']}</td>
    </tr>";
}
echo "</table>";
?>


