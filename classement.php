<?php
include 'menu.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Classement Équipes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">🏆 Classement des Équipes</h2>
    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
        <tr><th>Position</th><th>Équipe</th><th>Club</th><th>Points</th></tr>
        </thead>
        <tbody>
		
		<?php
		$json = file_get_contents('http://localhost/mon-api/api-classement-equipes.php');
		$equipes = json_decode($json, true);
		
		$position=1
		?>
		
		<?php foreach ($equipes as $equipe) { ?>
			<tr>
				<td><?= htmlspecialchars($position) ?></td>
				<td><?= htmlspecialchars($equipe['nom_equipe']) ?></td>
				<td><?= htmlspecialchars($equipe['nom_club']) ?></td>
				<td><?= htmlspecialchars($equipe['total_points']) ?></td>
			</tr>
		<?php $position++;} ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-primary">⬅ Retour Accueil</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
