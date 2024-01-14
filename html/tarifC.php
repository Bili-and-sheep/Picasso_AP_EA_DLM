<?php
// Connexion à la base de données (à ajuster selon votre configuration)
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Picash";


$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête pour récupérer les tarifs
$sql = "SELECT categorie, prix FROM tarifs";
$result = $conn->query($sql);

// Vérifier si la requête a réussi
if (!$result) {
    die("Erreur MySQLi: " . $conn->error);
}

// Récupérer les quantités de tickets soumises
$quantiteNormal = isset($_POST['normal']) ? intval($_POST['normal']) : 0;
$quantiteReduit = isset($_POST['reduit']) ? intval($_POST['reduit']) : 0;

// Ajoutez des variables similaires pour d'autres catégories

// Calculer le tarif total
$tarifTotal = 0;

while ($row = $result->fetch_assoc()) {
    $categorie = $row["categorie"];
    $prix = $row["prix"];

    switch ($categorie) {
        case 'Normal':
            $tarifTotal += $quantiteNormal * $prix;
            break;

        case 'Tarif réduit':
            $tarifTotal += $quantiteReduit * $prix;
            break;

        // Ajoutez des cas similaires pour d'autres catégories
    }
}

// Fermer la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tarif Total</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Menu de navigation (copiez celui que vous avez déjà) -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- ... -->
    </nav>

    <div class="container mt-5">

        <!-- Affichage du tarif total -->
        <h2 class="mb-4">Tarif Total</h2>

        <p>Le tarif total pour votre commande est de : <?php echo $tarifTotal; ?>€</p>

    </div>

    <!-- Scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
