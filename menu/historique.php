<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats du tirage</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            position: absolute;
            left: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php
    // Placez votre code de connexion à la base de données ici
    $servername = "localhost";
    $dbusername = "Talla";
    $dbpassword = "Talla";
    $dbname = "huissier";

    // Créer la connexion à la base de données
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Vérifier la connexion à la base de données
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Récupérer les résultats du tirage depuis la base de données
    $sql = "SELECT * FROM resultat ";
    $result = $conn->query($sql);

    // Vérifier s'il y a des résultats à afficher
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nom Huissier</th><th>Prénom Huissier</th><th>Date</th><th>Résultat</th><th>Jackpot</th></tr>";
        // Afficher chaque résultat dans une ligne du tableau
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nom_huissier"] . "</td>";
            echo "<td>" . $row["prenom_huissier"] . "</td>";
            echo "<td>" . $row["Date"] . "</td>";
            echo "<td>" . $row["resultat"] . "</td>";
            echo "<td>" . $row["jackpot"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Aucun résultat trouvé";
    }

    // Fermez la connexion à la base de données ici
   
    ?>
</body>
</html>
