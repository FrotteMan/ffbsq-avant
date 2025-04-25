<?php require 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Classement par Type</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Classement par Type de Compétition</h2>
    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
        <tr><th>Type</th><th>Total Points</th></tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT c.type_competition, SUM(r.points) AS total_points
            FROM resultat r
            JOIN competition c ON r.competition_id = c.id_competition
            GROUP BY c.type_competition
            ORDER BY total_points DESC";
        $data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $row):
            ?>
            <tr>
                <td><?= htmlspecialchars($row['type_competition'] ?? '') ?></td>
                <td><?= htmlspecialchars($row['total_points']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-primary">⬅ Retour Accueil</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
