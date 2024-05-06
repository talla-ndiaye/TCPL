<?php 
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: ../formulaire/1/test2.php");
    exit(); // Arrêter l'exécution du script après la redirection
}

// Récupérer le nom d'utilisateur depuis la session
$username = $_SESSION['username'];

// Base de données paramètres de connexion
$servername = "localhost";
$dbusername = "Talla";
$dbpassword = "Talla";
$dbname = "Joueurs";

// Créer la connexion à la base de données
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Vérifier la connexion à la base de données
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Préparer la requête SQL pour récupérer le nom et le prénom de l'utilisateur
$sql = "SELECT nom, prenom FROM joueur WHERE username = '$username'";
$result = $conn->query($sql);

// Vérifier si la requête a réussi
if ($result->num_rows > 0) {
    // Récupérer les données de l'utilisateur
    $row = $result->fetch_assoc();
    $nom = $row['nom'];
    $prenom = $row['prenom'];
} else {
    // Gérer le cas où aucun utilisateur correspondant n'est trouvé
    $nom = "Nom inconnu";
    $prenom = "Prénom inconnu";
}

// Fermer la connexion à la base de données
$conn->close();
?>

</head>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CodePen - Sidebar Menu</title>
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap'>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="tirage.css">
  <link rel="stylesheet" href="publier-clair.css">

</head>
<body>
<!-- partial:index.partial.html -->
<nav class="sidebar close">
  <header>
    <div class="image-text">
      <span class="image">
        <img src="https://drive.google.com/uc?export=view&id=1ETZYgPpWbbBtpJnhi42_IR3vOwSOpR4z" alt="">
      </span>

      <div class="text logo-text">
        <span class="name"><?php echo $nom ?></span>
        <span class="profession"><?php echo $prenom ?></span>
      </div>
    </div>

    <i class='bx bx-chevron-right toggle'></i>
  </header>

  <div class="menu-bar">
    <div class="menu">
      <li class="search-box">
        <i class='bx bx-search icon'></i>
        <input type="text" placeholder="Search...">
      </li>

      <ul class="menu-links">
        <li class="nav-link">
          <a href="#">
            <i class='bx bx-home-alt icon'></i>
            <span class="text nav-text">Infos Personnelles</span>
          </a>
        </li>

        <li class="nav-link">
          <a href="#" onclick="chargerPage('tirage.php');">
              <i class='bx bx-bar-chart-alt-2 icon'></i>
              <span class="text nav-text">Faire un tirage</span>
          </a>
      </li>


        <li class="nav-link">
        <a href="#" onclick="chargerPage('publier.php');">
            <i class='bx bx-bell icon'></i>
            <span class="text nav-text">PUBLIER</span>
          </a>
        </li>

        <li class="nav-link">
        <a href="#" onclick="chargerPage('historique.php');">
            <i class='bx bx-pie-chart-alt icon'></i>
            <span class="text nav-text">HISTORIQUE</span>
          </a>
        </li>

        
      </ul>
    </div>

    <div class="bottom-content">
      <li class="">
        <a href="logout.php">
          <i class='bx bx-log-out icon'></i>
          <span class="text nav-text">Déconnexion</span>
        </a>
      </li>

      <li class="mode">
        <div class="sun-moon">
          <i class='bx bx-moon icon moon'></i>
          <i class='bx bx-sun icon sun'></i>
        </div>
        <span class="mode-text text">Dark mode</span>
        <div class="toggle-switch">
          <span class="switch"></span>
        </div>
      </li>
    </div>
  </div>
</nav>

<section class="home">
  <div class="text">Salut, <?php echo "$nom $prenom" ?></div>
 
  <div id="contenuPrincipal">
    <!-- Le contenu sera chargé ici -->
</div>

</section>

<!-- partial -->
<script src="tirage.js"></script>
<script  src="./script.js"></script>

<body>
    <div class="container">
        <h2>Formulaire de tirage</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="number1">Nombre 1:</label>
            <input type="number" name="number1" id="number1" required>
            <label for="number2">Nombre 2:</label>
            <input type="number" name="number2" id="number2" required>
            <label for="number3">Nombre 3:</label>
            <input type="number" name="number3" id="number3" required>
            <label for="number4">Nombre 4:</label>
            <input type="number" name="number4" id="number4" required>
            <label for="number5">Nombre 5:</label>
            <input type="number" name="number5" id="number5" required>
            <input type="submit" value="Valider le tirage">
        </form>
    </div>
</body>
</html>

<?php
// Placez votre code de connexion à la base de données ici
$servername = "localhost";
$dbusername = "Talla";
$dbpassword = "Talla";
$dbname = "huissier";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $number1 = $_POST['number1'];
    $number2 = $_POST['number2'];
    $number3 = $_POST['number3'];
    $number4 = $_POST['number4'];
    $number5 = $_POST['number5'];

    // Concaténer les nombres avec des tirets
    $resultat = "$number1-$number2-$number3-$number4-$number5";

    // Créer la connexion à la base de données
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Vérifier la connexion à la base de données
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Préparer la requête SQL pour insérer les données dans la table resultat
    $sql = "INSERT INTO resultat (resultat) VALUES ('$resultat')";

    // Exécuter la requête SQL
    if ($conn->query($sql) === TRUE) {
        // Rediriger l'utilisateur vers une autre page après le traitement du formulaire
        header("Location: succes.php");
       
        exit(); // Assurez-vous de terminer le script après la redirection
    } else {
        echo "Erreur lors de l'enregistrement du tirage: " . $conn->error;
    }

    // Fermez la connexion à la base de données ici
    $conn->close();
}
?>

