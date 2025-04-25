<?php
session_start();
include 'menu.php';

// Adresse de ton API
$apiUrl = 'http://172.29.103.63/mon-api/api-login.php'; // Assure-toi que l'URL de l'API est correcte

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Préparer les données à envoyer à l'API
    $data = [
        'email' => $email,
        'mot_de_passe' => $mot_de_passe
    ];

    // Créer un contexte pour la requête POST
    $context = stream_context_create([
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data)
        ]
    ]);

    // Envoyer les données à l'API
    $response = file_get_contents($apiUrl, false, $context);

    // Décoder la réponse JSON
    $result = json_decode($response, true);

    // Vérifier la réponse de l'API
    if (isset($result['success']) && $result['success'] == true) {
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['role'] = $result['role'];
        $_SESSION['nom'] = $result['nom'];
        header("Location: index.php"); // Redirection vers la page d'accueil
        exit;
    } else {
        $error = isset($result['error']) ? $result['error'] : 'Email ou mot de passe incorrect.';
    }
}
?>

<div class="container mt-4">
    <h2 class="text-center">Connexion</h2>
    <?php if (isset($error)) { echo "<p class='alert alert-danger'>$error</p>"; } ?>
    <form method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="mot_de_passe" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>
</div>
