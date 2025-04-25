<?php
include 'menu.php';
?>

<div class="container mt-4">
    <h2 class="text-center">Compétitions à venir</h2>

    <?php
    $json = file_get_contents('http://172.29.103.63/mon-api/api-index.php');
    $competitions = json_decode($json, true);
    ?>

    <?php if (is_array($competitions) && count($competitions) > 0) { ?>
        <table class="table table-striped">
            <thead class="table-primary">
            <tr>
                <th>Nom</th>
                <th>Date</th>
                <th>Lieu</th>
                <th>Catégorie</th>
                <th>Type</th>
                <th>Nb équipes</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($competitions as $comp) { ?>
                <tr>
                    <td><?= htmlspecialchars($comp['nom_competition']) ?></td>
                    <td><?= htmlspecialchars($comp['date_competition']) ?></td>
                    <td><?= htmlspecialchars($comp['lieu']) ?></td>
                    <td><?= htmlspecialchars($comp['nom_categorie']) ?></td>
                    <td><?= htmlspecialchars($comp['nom_type']) ?></td>
                    <td><?= htmlspecialchars($comp['nb_equipes']) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center alert alert-info">Aucune compétition à venir.</p>
    <?php } ?>

    <h2 class="text-center mt-4">Navigation rapide</h2>
    <div class="text-center">
        <a href="creer_competition.php" class="btn btn-primary">Créer une Compétition</a>
        <a href="gestion_competitions.php" class="btn btn-warning">Gérer les Compétitions</a>
        <a href="ajouter_resultat.php" class="btn btn-success">Ajouter un Résultat</a>
        <a href="classement.php" class="btn btn-danger">Voir le Classement</a>
		<br>
		<br>
		<a href="adherents.php" class="btn btn-warning">Listing des adhérents</a>
		<!--<a href="classement_global.php" class="btn btn-danger">Classement Global</a>
		<a href="classement_type.php" class="btn btn-danger">Classement Type</a>
		<a href="classement_age.php" class="btn btn-danger">Classement Age</a>-->
	</div>
</div>
