<?php
    include 'menu.php';

    $id = $_GET['id']; // Récupération de l'ID passé en URL
    $competition = null;

    // Récupérer les informations de la compétition via l'API
    if (isset($id)) {
        $json = file_get_contents('http://172.29.103.63/mon-api/api-competitions-modifier.php?id=' . $id);
        $competition = json_decode($json, true);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire POST
        $id_competition = $_POST['id_competition'];
        $nom_competition = $_POST['nom_competition'];
        $date_competition = $_POST['date_competition'];
        $lieu = $_POST['lieu'];
        $nb_equipes = $_POST['nb_equipes'];

        // Préparer les données pour l'API
        $data = [
            'id_competition' => $id_competition,
            'nom_competition' => $nom_competition,
            'date_competition' => $date_competition,
            'lieu' => $lieu,
            'nb_equipes' => $nb_equipes
        ];

        // Créer un contexte de stream pour envoyer la requête POST
        $context = stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($data)
            ]
        ]);

        // Envoyer les données à l'API pour mettre à jour la compétition
        file_get_contents('http://localhost/mon-api/api-competitions-modifier.php', false, $context);

        // Rediriger après la modification
        header('Location: gestion_competitions.php'); // Redirige vers la page de gestion des compétitions
        exit;
    }
?>

<div class="container mt-4">
    <h2 class="text-center">Modifier la Compétition</h2>
    <form method="POST" action="modifier_competition.php?id=<?= $id ?>" class="needs-validation" novalidate>
        <input type="hidden" name="id_competition" value="<?= $competition['id_competition'] ?>">

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom_competition" class="form-control" value="<?= $competition['nom_competition'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date_competition" class="form-control" value="<?= $competition['date_competition'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lieu</label>
            <input type="text" name="lieu" class="form-control" value="<?= $competition['lieu'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre d'équipes</label>
            <input type="number" name="nb_equipes" class="form-control" value="<?= $competition['nb_equipes'] ?>" required>
        </div>

        <button type="submit" class="btn btn-warning w-100">Modifier</button>
    </form>
</div>
