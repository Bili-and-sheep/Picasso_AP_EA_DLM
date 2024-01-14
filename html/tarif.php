<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Picash";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT categorie, prix FROM tarifs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table'>
        <thead>
            <tr>
                <th>Catégorie</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["categorie"] . "</td>
            <td>" . $row["prix"] . "€</td>
        </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "Aucun résultat trouvé";
}

$conn->close();
?>
