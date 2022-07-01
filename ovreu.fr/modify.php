<?php
  require_once("controleur/controleur.class.php");
  //instanciation du Controleur
  $unControleur = new Controleur();
?>
<?php
      session_start();
      if(!$_SESSION['mdp']){ //Si il n'existe pas la session 'mdp' (connexion.php)
      header('location: index.php'); //alors on redirige vers connexion
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Modifier un salarié</title>
</head>
<body>
<center>
<div class="insertion">
<br>
	<?php
		$idsalarie = $_GET['idsalarie'];

		$lesClients = $unControleur->selectOneClient($idsalarie);
		//parcourir le tableau $lesClients et afficher client par client

		if(isset($lesClients)){
			foreach ($lesClients as $unClient) {
			  echo "<p class='who'> Vous modifiez : ".$unClient['nom']." ".$unClient['prenom']." <br> Son e-mail est : ".$unClient['email']." <br> Et sa date d'embauche : ".$unClient["date_format(dateembauche,'%D %b %Y')"]."</p>";
		}
		}
	?>
<br>
<hr>
<h2>MODIFIER UN SALARIÉ</h2>
<form method="post" action="">
	<table>
        <tr>
			<td><input type="hidden" name="idsalarie"></td>
		</tr>
		<tr>
			<td>Nom : </td>
			<td><input type="text" name="nom" value=""></td>
		</tr>
		<tr>
			<td>Prenom : </td>
			<td><input type="text" name="prenom" value=""></td>
		</tr>
		<tr>
			<td>Email : </td>
			<td><input type="text" name="email" value=""></td>
		</tr>
		<tr>
			<td>Date d'embauche : </td>
			<td><input type="date" name="dateembauche" value=""></td>
		</tr>
		<tr>
			<td><input type="reset" name="Annuler" value="Annuler"></td>
			<td><input type="submit" name="Modifier" value="Modifier"></td>
		</tr>
	</table>
</form>

</br>

<?php
	if(isset($_POST['Modifier']))
  	{
    $tab = array("idsalarie"=>$_GET["idsalarie"],
    "nom"=>$_POST['nom'],
    "prenom"=>$_POST['prenom'],
    "email"=>$_POST['email'],
    "dateembauche"=>$_POST['dateembauche']
 	 );
  	$unControleur->modifyClient($tab);
    $unControleur->deleteAllInterventions($tab);
	$unControleur->inser_tech2bis($tab);
	$unControleur->inser_tech1bis($tab);
	$unControleur->inser_reu_guillaumebis($tab);
	$unControleur->inser_reu_michelbis($tab);
    echo "Le salarié séléctionné à bien été modifié.";
    echo "<br>";
 	}
?>
<hr>
<img src="images/back.png" alt="" width="20px" class="backimg">
<div class="backlink">
<a href="salarie.php" class="linkback">  revenir à la liste des salariés</a>
</div>
</div>
</center>	
<div class="red">

</div>
</body>
</html>


<style>
@import url('https://fonts.googleapis.com/css2?family=Varela+Round&display=swap');
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

.linkback{
font-size: 20px;
text-decoration: none;
color: black;

}

.backlink{
	padding-bottom: 10px;
}
.insertion{
		border-radius: 4px;
		width: 30%;
		padding-bottom: 10px;
		background: linear-gradient(90deg, white 98%, #D6274C 98%);
		margin-left:3%;
		margin-top: 6%;
	}
input{
	border: none;
	border-radius: 4px;
	background-color: rgba(231,231,230,255);
	width:  80%;
	height: 5%;
	margin-bottom: 5%;
}
h2{
	font-family: 'Varela Round', sans-serif;
	color: rgba(0, 0, 0, 0.70);
}
.who{
	font-size: 18px;
}
hr{
	margin-right:2%;
	border: solid 1px rgba(0, 0, 0, 0.1);
}
</style>
