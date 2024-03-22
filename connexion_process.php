<?php
session_start();

// Informations de connexion à la base de données
$servername = "localhost"; // Adresse du serveur MySQL
$username_db = "root"; // Nom d'utilisateur de la base de données
$password_db = ""; // Mot de passe de la base de données
$database = "base_start"; // Nom de la base de données

try {
    // Connexion à la base de données avec PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username_db, $password_db);
    // Configuration des attributs PDO pour générer des exceptions en cas d'erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifier si les champs sont vides
        if (empty($_POST['username']) || empty($_POST['password'])) {
            echo "Veuillez saisir votre nom d'utilisateur et votre mot de passe.";
        } else {
            // Préparer les données pour la requête SQL
            $username = $_POST['username'];
            $password = $_POST['password'];
            $pass = strval($password);


            // Hacher le mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Préparer la requête SQL pour vérifier les informations d'identification
            $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si l'utilisateur existe et vérifier le mot de passe haché
            if (password_verify($password, $row['password'])) {
                // Démarrer la session et stocker le nom d'utilisateur
                $_SESSION['username'] = $username;
                // Rediriger vers le tableau de bord
                header("Location: dashboard.php");
                exit(); // Arrêter l'exécution du script après la redirection
            } else{
                echo "bonjour";
                $test = password_verify($pass, $row['password']);
                echo $password;
                echo "<br>";
                echo $hashed_password;
                echo "<br>";
                echo $row['password'];
            }
        }
    }
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}

// Fermer la connexion à la base de données (facultatif car PDO gère automatiquement la fermeture de la connexion à la fin du script)
$conn = null;
?>
