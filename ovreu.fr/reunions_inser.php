<?php
      session_start();
      if(!$_SESSION['mdp']){ //Si il n'existe pas la session 'mdp' (connexion.php)
      header('location: index.php'); //alors on redirige vers connexion
      }
?>
<?php
  require_once("controleur/controleur.class.php");
  //instanciation du Controleur
  $unControleur = new Controleur();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gérer les réunions</title>
</head>
<body>
<center>
<div class="navbar">
  <ul class="tabs group">   
    <li class="inser_reu active"><a href="reunions_inser.php">GÉRER LES RÉUNIONS</a></li>
    <li><a href="reunions_consult.php">DATES CALCULÉES</a></li> 
 <li><a href="reunions_month.php">RÉUNIONS DU MOIS</a></li>
  <li><a href="salarie.php">GÉRER LES SALARIÉS</a></li> 
  <li><a href="index.php">ACCUEIL</a></li>
  </ul>
  <a class="logout" href="logout.php"><img src="images/logout.png" alt="" width="23px" height="23px"></a>
</div>
<?php
		$leClient = null;
		if (isset($_GET['action']) and isset($_GET['idsalarie']))
		{
			$tabrv = array("idsalarie"=>$_GET['idsalarie'],
    "datereunionvalide"=>$_GET['datereunionvalide'],
    "heurereunionvalide"=>$_GET['heurereunionvalide']
 	 );
			$action = $_GET['action'];

			switch($action)
			{
				case "sup" : $unControleur->deleteReunionValide($tabrv); break;
			}
		}
?>
<?php

  require_once ("vue/vue_insert_intervention.php");

  if(isset($_POST['Valider']))
  {
    $tab = array("datereunion"=>$_POST['datereunion'],
    "heurereunion"=>$_POST['heure'],
    "libelle"=>$_POST['libelle'],
    "idsalarie"=>$_POST['idsalarie']
  );
  $unControleur->insertInterventionvalide($tab);

  }
  //extraction de toutes les interventions
  
?>
<br><br>
<div class="liste">
	<table class="affichagereunionsvalide">
	<tr class="firstline">
    	<td class="color2"> ㅤNOMㅤ</td>
    	<td class="color2"> ㅤPRENOMㅤ</td>
    	<td class="color2"> LIBELLE</td>
    	<td class="color2">ㅤDATEㅤ</td>
		<td class="color2">HEURE</td>
	<td class="color2"> SUPPR</td>
	</tr>
	<?php
		//récupérer la liste des clients de la BDD
		$lesInterventionsValide = $unControleur->selectAllInterventionsValide();
		//parcourir le tableau $lesClients et afficher client par client
		
		if(isset($lesInterventionsValide)){
		  foreach ($lesInterventionsValide as $uneInterventionValide) {
			echo "<tr>";
			echo "<td>".$uneInterventionValide['nom']."</td>";
			echo "<td>".$uneInterventionValide['prenom']."</td>";
			echo "<td>".$uneInterventionValide['libelle']."</td>";
			echo "<td>".$uneInterventionValide["date_format(rv.datereunion, '%D %b %Y')"]."</td>";
			echo "<td>".$uneInterventionValide['heurereunion']."</td>";
			 echo "<td>";
			 echo "<a href='reunions_inser.php?page=1&action=sup&idsalarie=".$uneInterventionValide['idsalarie']."&heurereunionvalide=".$uneInterventionValide['heurereunion']."&datereunionvalide=".$uneInterventionValide["date_format(rv.datereunion, '%D %b %Y')"]."'><img src= 'images/delete.png' width='22' heigth='22'> </a>";
			  echo "</td>";
			echo "</tr>";
		  }
		}
		
			
	?>
	</table>
	</div>


</center>
<div class="red">

</div>
</body>
</html>




<style>
	@import url('https://fonts.googleapis.com/css2?family=Gothic+A1:wght@600&display=swap');
	@import url('https://fonts.googleapis.com/css2?family=Varela+Round&display=swap');

	body{
		overflow-x: hidden;
  		margin: 0px;
  		padding: 0px;
  		background-color: #EBEBEB;
		
	}
form{
margin:0;
}
	.red{
 	width: 93%;
 	height: 110%;
 	position: fixed;
 	bottom: 0px;
 	clip-path: polygon(0 25%, 42% 61%, 88% 100%, 0% 100%);
 	background: linear-gradient(110deg, #FF2552 50%, #D6274C 50%);
 	z-index: -1;
	}

.error{
position: fixed;
width: 100%;
text-align: center;
bottom: 0;
border: 2px solid red;
font-size: 20px;
color: red;
background-color: yellow;
}

input,select{
	border: none;
	border-radius: 4px;
	background-color: rgba(231,231,230,255);
	width:  80%;
	height: 4%;
	margin-bottom: 5%;
}
.Valider,.Annuler{
	font-family: 'Khula', sans-serif;
	background-color: rgba(0,0,0,0.66);
	color: white;
}
.insertion{
	border-radius: 4px;
	width: 30%;
	padding-bottom: 10px;
	background: linear-gradient(90deg, white 98%, #D6274C 98%);
	float: left;
	margin-left:3%;
	margin-top: 4.5%;
}
.liste{
	float: right;
	margin-right: 2%;
	margin-top: 2.7%;
	font-family: 'Varela Round', sans-serif;
	z-index: 2;
	margin-bottom : 5%;
}
h2{
	color: rgba(0,0,0,0.66);
	margin-bottom: 2%;
	font-family: 'Varela Round', sans-serif;
}
hr{
	width: 60%;
	margin-top: 0;
	margin-bottom: 4%;
	margin-left: 10%;
	height: 0.7%;
	background-color: #D6274C;
	border: none;
	border-radius: 2px;
}

h3{
	font-size: 17px;
	color: rgba(0,0,0,0.5);
	margin: 0;
	font-family: 'Varela Round', sans-serif;
}












.affichagereunionsvalide td{
padding:10px;
}
.affichagereunionsvalide{
		font-size: 23px;
 		border-radius: 0.3em;
  		overflow: hidden;
		text-align: center;
		border-collapse: collapse;
		background-color:white;
	}
.color2{
		background-color: rgba(0,0,0,0.66);
	}
.firstline{
		color: white;
		font-family: 'Varela Round', sans-serif;
		user-select: none;
	}
	.navbar{
		width: 100%;
  font-size: 12px;
  color: black;
  top: 0%;
  right: 0%;
  position: absolute;
  margin-left: 32%;
  font-family: 'Gothic A1', sans-serif;
  background-color: rgba(255, 37, 82, 1);
}

.inser_reu{
  margin-right: 5%;
}
.tabs { 
    	list-style: none; 
    	width: 100%;
      margin: 0;
      margin-top: 0.2%;
    }
    .tabs li { 
		  /* Makes a horizontal row */
			float: right; 
			
			/* So the psueudo elements can be
			   abs. positioned inside */
			position: relative; 
		}
		.tabs a { 
		  /* Make them block level
		     and only as wide as they need */
		  float: right; 
		  padding: 5px 40px; 
		  text-decoration: none;
		  
		  /* Default colors */ 
		  color: black;
		  background: #FF2552;
		  
		  /* Only round the top corners */
		  -webkit-border-top-left-radius: 15px;
		  -webkit-border-top-right-radius: 15px;
		  -moz-border-radius-topleft: 15px;
		  -moz-border-radius-topright: 15px;
		  border-top-left-radius: 15px;
		  border-top-right-radius: 15px; 
		}
		.tabs .active {
		  /* Highest, active tab is on top */
		  z-index: 3;
		}
		.tabs .active a { 
		  /* Colors when tab is active */
		  background:#EBEBEB;
		  color: black; 
		}
		.tabs li:before, .tabs li:after, 
		.tabs li a:before, .tabs li a:after {
		  /* All pseudo elements are 
		     abs. positioned and on bottom */
		  position: absolute;
		  bottom: 0;
		}
		/* Only the first, last, and active
		   tabs need pseudo elements at all */
		.tabs li:last-child:after,   .tabs li:last-child a:after,
		.tabs li:first-child:before, .tabs li:first-child a:before,
		.tabs .active:after,   .tabs .active:before, 
		.tabs .active a:after, .tabs .active a:before {
		  content: "";
		}
		.tabs .active:before, .tabs .active:after {
		  background: #EBEBEB;
		  
		  /* Squares below circles */
		  z-index: 1;
		}
		/* Squares */
		.tabs li:before, .tabs li:after {
		  background: #FF2552;
		  width: 10px;
		  height: 10px;
		}
		.tabs li:before {
		  left: -10px;      
		}
		.tabs li:after { 
		  right: -10px;
		}
		/* Circles */
		.tabs li a:after, .tabs li a:before {
		  width: 20px; 
		  height: 20px;
		  /* Circles are circular */
		  -webkit-border-radius: 10px;
		  -moz-border-radius:    10px;
		  border-radius:         10px;
		  background: #FF2552;
		  
		  /* Circles over squares */
		  z-index: 2;
		}
		.tabs .active a:after, .tabs .active a:before {
		  background: #FF2552;
		}
		/* First and last tabs have different
		   outside color needs */
		.tabs li:first-child.active a:before,
		.tabs li:last-child.active a:after {
		  background: #FF2552;
		}
		.tabs li a:before {
		  left: -20px;
		}
		.tabs li a:after {
		  right: -20px;
		}
        .group:before,
        .group:after {
          content: "";
          display: table;
        }
        .group:after {
          clear: both;
        }
        .group {
          zoom: 1;
        }
       
        .logout{
 		     padding: 0;
 		     margin: 0;
  	  	 position: absolute;
  		   float: left;
 		     top: 2px;
  		   left: 5px;
		    }



@media only screen and (max-width:1000px){
		.insertion{
			width: 90%;
			margin-left:5%;
			margin-right:5%;
		}
		.liste{
			width: 90%;
			margin-left:0;
			margin-right:0;
		}
		.affichagereunionsvalide{
	font-size:10px;
	}
	}
	</style>
