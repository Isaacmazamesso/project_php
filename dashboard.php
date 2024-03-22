<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
?>   
<!DOCTYPE html>
<html>
<head>
<style>
     body {
	background:blue;
	display: flex;
	justify-content: center;
	align-items: center;
	height: 110vh;
	flex-direction: column;
     }
     input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-top: 20px;
      background-color: orange;
      color: white;
      border: solid;
      border-radius: 10px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      opacity: .3;
    }

</style>

	<title>HOME</title>
     
	
</head>
<body>
     <h1>Bienvenu, <?php echo $_SESSION['username']; ?></h1>
     <a href="connexion.php"> <input type="submit" value="DECONNEXION"></a>
</body>
</html>

<?php 
}else{
     header("Location: connexion.php");
     exit();
}
 ?>

