

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace de connexion OV</title>
</head>
<body>
    <center>
    <img src="images/OVlogosf.png" alt="" width="160px" height="125px">
    <form action="" method="POST" align="center">
        <input type="text" name="login" autocomplete="off" placeholder="Login">
        <br>
        <input type="password" name="mdp" placeholder="Mot de passe"">
        <br><br>
        <input type="submit" name="Valider" value="Connecter"   >
    </form>
    </center>

    <style>
        img{
            margin-top: 10%;
        }
    </style>

<?php
session_start();
if(isset($_POST['Valider'])){ //si le bouton valider est préssé
    if(!empty($_POST['login']) AND !empty($_POST['mdp'])){ //Et que le mot de passe et login ne sont pas vide
        $login_par_defaut = "Openvalue"; //On définit le login   
        $mdp_par_defaut = "Openvalue75!"; //On définit le mdp

        $login_saisi = htmlspecialchars($_POST['login']); //variable login saisi  
        $mdp_saisi = htmlspecialchars($_POST['mdp']); //variable mdp saisi

        if($login_saisi == $login_par_defaut and $mdp_saisi == $mdp_par_defaut){ //Si mdp et login saisi correspondent aux login et mdp saisis :
            $_SESSION['mdp'] = $mdp_saisi; //On définit la session, qu'on pourra détruire lors de la déconnexion (logout.php)
            header('location: accueil.php'); //On redirige vers index.php
        }else{ //Si login et/ou mdp incorrect alors :
            echo "<br><center>Votre Login ou mdp est incorrect</center>";
        }
    }else{ //si login et/ou mdr vide alors :
        echo "<br><center> Veuillez compléter tous les champs.. </center>";
    }
}
?>
 <div class="red">

</div>
</body>
</html>



<style>
body{
  overflow-y: hidden;
  overflow-x: hidden;
  margin: 0px;
  padding: 0px;
  background-color: #EBEBEB;
 
}

.red{
 width: 93%;
 height: 110%;
 position: fixed;
 bottom: 0px;
 clip-path: polygon(0 25%, 42% 61%, 88% 100%, 0% 100%);
 background: linear-gradient(110deg, rgba(255, 37, 82,1) 50%, rgba(214, 39, 76,1) 50%);
 z-index: -1;
}
