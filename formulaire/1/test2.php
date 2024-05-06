<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['username'])) {
    // Rediriger vers la page aceuill.php si l'utilisateur est déjà connecté
    header("Location: ../../menu/acceuil.php");
    exit(); // Arrêter l'exécution du script après la redirection
}



$Erroridentifiant = $Einscription="";

// Fonction pour générer le formulaire de connexion
function connection()
{ ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login">
        <span class="<?php echo "$GLOBALS[notification]"; ?>"><?php echo "$GLOBALS[Erroridentifiant]"; ?></span>
        <div class="field">
            <input type="text" placeholder="username" name="username" required>
        </div>
        <div class="field">
            <input type="password" placeholder="password" name="password" required>
        </div>
        <div class="pass-link"><a href="#">Forgot password?</a></div>
        <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="Login">
        </div>
        <div class="signup-link">Not a member? <a href="#">Signup now</a></div>
    </form>
<?php }

// Base de données paramètres de connexion
$servername = "localhost";
$dbusername = "Talla";
$dbpassword = "Talla";
$dbname = "Joueurs";

// Créer la connexion
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmpassword'])) {
        // Inscription
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $username = $_POST['username'];
        $age = $_POST['age'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        
        // SQL query to check if username already exists
        $check_username_query = "SELECT * FROM joueur WHERE username='$username'";
        $check_username_result = $conn->query($check_username_query);
        
        if ($check_username_result->num_rows > 0) {
            $Einscription= "Cet utilisateur existe déjà.";
            $notification = "echec";
            
        } else {
              if ($password !== $confirmpassword) {
                    $Einscription = "Les mots de passe ne correspondent pas.";
                    $notification = "echec";
           
                } else{
                    // SQL query to insert data into database
                    $sql = "INSERT INTO joueur (nom, prenom, username, mdp) VALUES ('$nom', '$prenom', '$username', '$password')";

                    if ($conn->query($sql) === TRUE) {
                        $Einscription = "inscrit avec succès
                        vous pouvez vous connecter";
                        $nom =  $prenom = $username = $password =$confirmpassword = "";
                        $notification = "succes";
                        
                    } else {
                                echo "Erreur: " . $sql . "<br>" . $conn->error;
                            }
                }

        }
    } else {
        // Connexion
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Préparer la requête SQL pour vérifier les identifiants
        $sql = "SELECT * FROM joueur WHERE username='$username' AND mdp='$password'";
        $result = $conn->query($sql);

        // Vérifier si l'utilisateur existe dans la base de données
            if ($result->num_rows > 0) {
                // Utilisateur authentifié avec succès
                $Erroridentifiant = "Connexion réussie !";
                $notification = "succes";
                
                // Démarrer la session
                session_start();
                
                // Stocker le nom d'utilisateur dans la session
                $_SESSION['username'] = $username;
                
                // Rediriger l'utilisateur vers aceuill.php
                header("Location: ../../menu/acceuil.php");
                exit(); // Arrêter l'exécution du script après la redirection
            } else {
                // Identifiants incorrects
                $Erroridentifiant = "Identifiants incorrects";
                $notification = "echec";
              }    
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CodePen - login &amp; signup form</title>
    <link rel="stylesheet" href="./style.css">
    <style>
    .echec {
        color: #FF0000;
        position: center;
        width: 100%;
        background-color: #F08080;
    }
    .succes{
        color : green;
        text-align: center;
        width: 100%;
        background-color: #98FB98;

    }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">Login Form</div>
            <div class="title signup">Signup Form</div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <?php connection(); ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="signup">
                    
                    <span class="<?php echo "$GLOBALS[notification]"; ?>"><?php echo "$GLOBALS[Einscription]"; ?></span>
                    <div class="field">
                        <input type="text" placeholder="nom" name="nom" value="<?php echo isset($nom) ? $nom : ''; ?>" required>
                        
                    </div>
                    <div class="field">
                        <input type="text" placeholder="prenom" name="prenom" value="<?php echo isset($prenom) ? $prenom : ''; ?>" required>
                        
                    </div>

                    <div class="field">
                        <input type="password" placeholder="Password" name="age" value="<?php echo isset($age) ? $age : ''; ?>"  required>
                        
                    </div>

                    <div class="field">
                        <input type="text" placeholder="username" name="username" value="<?php echo isset($username) ? $username : ''; ?>" required>
                        
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Password" name="password"  required>
                        
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Confirm password" name="confirmpassword"  required>
                       
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Signup">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="./script.js"></script>
</body>

</html>
