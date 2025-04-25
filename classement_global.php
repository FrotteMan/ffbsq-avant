<?php require 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Classement Global</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Classement Global</h2>
    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
        <tr><th>Club</th><th>Total Points</th></tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT c.nom_club, SUM(r.points) AS total_points
            FROM resultat r
            JOIN equipe e ON r.equipe_id = e.id_equipe
            JOIN club c ON e.club_id = c.id_club
            GROUP BY c.nom_club
            ORDER BY total_points DESC";
        $data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $row):
            ?>
            <tr>
                <td><?= htmlspecialchars($row['nom_club']) ?></td>
                <td><?= htmlspecialchars($row['total_points']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="../index.php" class="btn btn-primary">⬅ Retour Accueil</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
