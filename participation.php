<?php require 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Participation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Participation aux Compétitions</h2>
    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
        <tr><th>Nom</th><th>Prénom</th><th>Participations</th><th>Taux %</th></tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT a.nom, a.prenom, COUNT(p.id_participation) AS nb_participations,
            ROUND((COUNT(p.id_participation) / 
            (SELECT COUNT(*) FROM competition)) * 100, 2) AS taux
            FROM adherents a
            LEFT JOIN participations p ON a.id_adherent = p.adherent_id
            GROUP BY a.id_adherent";
        $data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $row):
            ?>
            <tr>
                <td><?= htmlspecialchars($row['nom']) ?></td>
                <td><?= htmlspecialchars($row['prenom']) ?></td>
                <td><?= htmlspecialchars($row['nb_participations']) ?></td>
                <td><?= htmlspecialchars($row['taux']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="../Mission3/index.php" class="btn btn-primary">⬅ Retour Accueil</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
