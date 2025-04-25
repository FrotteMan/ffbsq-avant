<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

include 'menu.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire POST
    $competition_id = $_POST['competition_id'];
    $equipe_id = $_POST['equipe_id'];
    $position = $_POST['position'];

    // Préparer les données pour l'API
    $data = [
        'competition_id' => $competition_id,
        'equipe_id' => $equipe_id,
        'position' => $position
    ];

    // Créer un contexte de stream pour envoyer la requête POST
    $context = stream_context_create([
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data)
        ]
    ]);

    // Envoyer les données à l'API pour ajouter le résultat
    file_get_contents('http://localhost/mon-api/api-resultat.php', false, $context);

    // Rediriger après l'ajout du résultat
    header('Location: ajouter_resultat.php'); // Redirige vers la page de gestion des résultats
    exit;
}

// Récupérer les compétitions et les équipes depuis l'API
$json = file_get_contents('http://localhost/mon-api/api-resultat.php?id=1');
$competitions = json_decode($json, true);

$json = file_get_contents('http://localhost/mon-api/api-resultat.php?id=2');
$equipes = json_decode($json, true);
?>

<div class="container mt-4">
    <h2 class="text-center">Ajouter un Résultat</h2>
    <form method="POST" action="ajouter_resultat.php" class="needs-validation" novalidate>

        <div class="mb-3">
            <label class="form-label">Compétition</label>
            <select name="competition_id" class="form-select" required>
                <?php foreach ($competitions as $comp) { ?>
                    <option value="<?= $comp['id_competition']; ?>"><?= $comp['nom_competition']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Équipe</label>
            <select name="equipe_id" class="form-select" required>
                <?php foreach ($equipes as $equipe) { ?>
                    <option value="<?= $equipe['id_equipe']; ?>"><?= $equipe['nom_equipe']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Position</label>
            <select name="position" class="form-select" required>
                <option value="1">1ère place</option>
                <option value="2">2ème place</option>
                <option value="3">3ème place</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success w-100">Ajouter le résultat</button>
    </form>
</div>
