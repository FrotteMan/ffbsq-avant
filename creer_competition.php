<?php
include 'menu.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire POST
	$nom_competition = $_POST['nom_competition'];
	$date_competition = $_POST['date_competition'];
    $lieu = $_POST['lieu'];
    $categorie_id = $_POST['categorie_id'];
	$type_id = $_POST['type_id'];
	$nb_equipes = $_POST['nb_equipes'];
	$description = $_POST['description'];

    // Préparer les données pour l'API
    $data = [
        'nom_competition' => $nom_competition,
        'date_competition' => $date_competition,
        'lieu' => $lieu,
		'categorie_id' => $categorie_id,
		'type_id' => $type_id,
		'nb_equipes' => $nb_equipes,
		'description' => $description
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
    file_get_contents('http://172.29.103.63/mon-api/api-competitions.php', false, $context);

    // Rediriger après l'ajout du résultat
    header('Location: gestion_competitions.php'); // Redirige vers la page de gestion des résultats
    exit;
}
?>

<div class="container mt-4">
    <h2 class="text-center">Créer une Compétition</h2>
    <form method="POST" action="creer_competition.php" class="needs-validation" novalidate>

        <div class="mb-3">
            <label class="form-label">Nom de la compétition</label>
            <input type="text" name="nom_competition" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date_competition" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lieu</label>
            <input type="text" name="lieu" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Catégorie</label>
            <select name="categorie_id" class="form-select" required>
                <option value="1">Senior</option>
                <option value="2">Junior</option>
                <option value="3">Cadet</option>
                <option value="4">Vétéran</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type_id" class="form-select" required>
                <option value="1">Individuel</option>
                <option value="2">Doublette</option>
                <option value="3">Triplette</option>
                <option value="4">Quadrette</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre d'équipes</label>
            <input type="number" name="nb_equipes" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Créer la compétition</button>
    </form>
</div>
