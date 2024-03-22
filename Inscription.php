<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>
<body>
    <form action="inscription_process" method="POST">
        <label for="username"> Nom d'utilisateur</label>
        <input type="text" id="username" name="username" required> <br>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required> <br>
        <label for="confirm_password">Confirmer mot de passe</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        <input type="submit" name="submit" value="S'inscrire">
        <a href="connexion.php" class="a">Avez-vous deja un compte ?<br> Se connecter</a>
    </form>
 
   
</body>
</html>