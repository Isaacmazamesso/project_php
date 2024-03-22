<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "base_start";

    try{
        $pdo = new PDO("mysql:host=$servername;dbname=$db_name",$username,$password);
        //Definition du mode d'erreur de PDO su Exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    //Recuperation des donnees de la base
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    //Verifions si l'utilisateur existe 
    $query = "SELECT * FROM utilisateur WHERE username= ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username]);

    if ($stmt->rowcount() > 0){
        echo "L'utilisateur existe deja";
    } elseif ($password !== $confirm_password){
        echo "Les mots de passe sont differents";
    } else{
        //Ajouter l'utilisateur a la base de donnees
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);//Hashage du password
        $insert_query = "INSERT INTO utilisateur VALUES(?,?) ";
        $stmt = $pdo->prepare($insert_query);

        try{
            $stmt->execute([$username, $hashed_password]);
            echo "inscription reussie. <a>Veuillez-vous connecter<a>";
            header("Location: connexion.php");
        } catch(PDOException $e){
            echo "erreur lors de l'inscription : ".$e->getMessage();
        }
    }  
    
} 
catch(PDOException $e){
    echo "erreur: ".$e->getMessage();
} finally {
    //fermeture de la connexion
    $pdo = null;
}
?>