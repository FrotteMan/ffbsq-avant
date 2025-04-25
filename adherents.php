<?php
include 'menu.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Adhérents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Liste des Adhérents</h2>
    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
        <tr><th>Nom</th><th>Prénom</th><th>Âge</th><th>Catégorie</th><th>Club</th></tr>
        </thead>
        <tbody>
		
		<?php
		$json = file_get_contents('http://localhost/mon-api/api-adherents.php');
		$adherents = json_decode($json, true);
		?>
		
		<?php foreach ($adherents as $adherent) { ?>
			<tr>
				<td><?= htmlspecialchars($adherent['nom_joueur']) ?></td>
				<td><?= htmlspecialchars($adherent['prenom_joueur']) ?></td>
				<td><?= htmlspecialchars($adherent['age']) ?></td>
				<td><?= htmlspecialchars($adherent['categorie_age']) ?></td>
				<td><?= htmlspecialchars($adherent['nom_club']) ?></td>
			</tr>
		<?php } ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-primary">⬅ Retour Accueil</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
