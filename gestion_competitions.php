<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include 'menu.php';

// Si on soumet un formulaire de suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Appel à l'API de suppression
    $data = http_build_query(['id_competition' => $delete_id]);
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $data
        ]
    ]);

    $result = file_get_contents('http://localhost/mon-api/api-competitions-supprimer.php', false, $context);
    $response = json_decode($result, true);

    if (!isset($response['success']) || $response['success'] !== true) {
        $message = "❌ Erreur lors de la suppression.";
        if (isset($response['error'])) {
            $message .= " Détail : " . $response['error'];
        }
    } else {
        $message = "✅ Compétition supprimée avec succès.";
    }
}

// Récupération des compétitions depuis l’API
$json = file_get_contents('http://localhost/mon-api/api-competitions.php');
$competitions = json_decode($json, true);
?>

<div class="container mt-4">
    <h2 class="text-center">Gestion des Compétitions</h2>

    <?php if (isset($message)) { ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php } ?>

    <?php if (!empty($competitions)) { ?>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Catégorie</th>
                    <th>Type</th>
                    <th>Nb équipes</th>
                    <th>Actions</th>
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
                        <td>
                            <a href="modifier_competition.php?id=<?= $comp['id_competition'] ?>" class="btn btn-warning btn-sm">Modifier</a>

                            <!-- Formulaire de suppression -->
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cette compétition ?');">
                                <input type="hidden" name="delete_id" value="<?= $comp['id_competition'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-warning">Aucune compétition trouvée.</div>
    <?php } ?>

    <div class="mt-3">
        <a href="creer_competition.php" class="btn btn-success">+ Créer une compétition</a>
        <a href="index.php" class="btn btn-primary">⬅ Retour Accueil</a>
    </div>
</div>
