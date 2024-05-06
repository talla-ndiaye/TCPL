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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CodePen - Sidebar Menu</title>
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap'>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="tirage.css">
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
          <a href="tirage.php">
              <i class='bx bx-bar-chart-alt-2 icon'></i>
              <span class="text nav-text">Faire un tirage</span>
          </a>
      </li>


        <li class="nav-link">
        <a href="publier.php">
            <i class='bx bx-bell icon'></i>
            <span class="text nav-text">PUBLIER</span>
          </a>
        </li>

        <li class="nav-link">
        <a href="historique.php">
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

<!--<script>
//ce script permet de recuperer une aure page et l'inclure dans cette page

function chargerPage(url) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Charger le contenu de la page
            document.getElementById("contenuPrincipal").innerHTML = this.responseText;
            // Appliquer le mode sombre/clair sur le nouveau contenu
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}
</script> -->


</body>
</html>
