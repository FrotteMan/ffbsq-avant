<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Compétitions</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<!-- Bootstrap JS + jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">FFBSQ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <!-- Accueil -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">Accueil</a>
            </li>

            <!-- Gestion compétitions -->
            <li class="nav-item">
                <a class="nav-link" href="gestion_competitions.php">Compétitions</a>
            </li>

            <!-- Classements -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="classementsDropdown" role="button" data-toggle="dropdown">
                    Classements
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../Mission6/classement_global.php">Global</a>
                    <a class="dropdown-item" href="../Mission6/classement_age.php">Par Âge</a>
                    <a class="dropdown-item" href="../Mission6/classement_type.php">Par Type</a>
                    <a class="dropdown-item" href="../Mission6/participation.php">Participation</a>
                    <a class="dropdown-item" href="../Mission6/adherents.php">Adhérents</a>
                </div>
            </li>
        </ul>

        <!-- Zone connexion -->
        <ul class="navbar-nav">
            <?php if (isset($_SESSION['utilisateur'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Connexion</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



