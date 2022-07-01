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
  <title>Dates calculées</title>
</head>
<body>
<div class="navbar">
  <ul class="tabs group">   
	  <li class="inser_reu"><a href="reunions_inser.php">GÉRER LES RÉUNIONS</a></li>
	  <li class="active"><a href="reunions_consult.php">DATES CALCULÉES</a></li>
	 <li><a href="reunions_month.php">REUNIONS DU MOIS</a></li>  
		<li><a href="salarie.php">GRER LES SALARIÉS</a></li> 
		<li><a href="accueil.php">ACCUEIL</a></li>
  </ul>
  <a class="logout" href="logout.php"><img src="images/logout.png" alt="" width="23px" height="23px"></a>
</div>
<center>
<h1>Liste des dates calculées : </h1>
<?php
$lesInterventions = $unControleur->selectAllInterventions();

  require_once ("vue/vue_les_interventions.php");
?>  
</center>
<a href="#" class="top">Back to Top &#8593;</a>
<div class="red">

</div>
</body>
</html>




<style>
	@import url('https://fonts.googleapis.com/css2?family=Gothic+A1:wght@600&display=swap');
	@import url('https://fonts.googleapis.com/css2?family=Khula:wght@700&display=swap');
	@import url('https://fonts.googleapis.com/css2?family=Varela+Round&display=swap');
	.top {
		  --offset: 50px; 
  
	  	position: sticky;
	  	bottom: 20px;      
	  	margin-right:10px; 
	  	place-self: end;
	  	margin-top: calc(100vh + var(--offset));
  
	  	text-decoration: none;
	  	padding: 10px;
	  	font-family: sans-serif;
	  	color: #fff;
		float : right;
	  	background: #000;
	  	border-radius: 100px;
	  	white-space: nowrap;
	}

	html,body {
		  scroll-behavior: smooth;
	}

	body{
		overflow-x: hidden;
  		margin: 0px;
  		padding: 0px;
  		background-color: #EBEBEB;
		
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
	.affichagereunions{
	font-size: 20px;
 	border-radius: 0.3em;
  	overflow: hidden;
	text-align: center;
	border-collapse: collapse;
	font-family: 'Varela Round', sans-serif;
	background-color: white;
	}
	

	.affichagereunions tr{
	padding-left: 5px;
	border-top: 1px solid rgba(0,0,0,0.1);
	}

	.color2{
	background-color: rgba(0,0,0,0.66);
	}

	.firstline{
		color: white;
		font-family: 'Varela Round', sans-serif;
		user-select: none;
	}
	
	.contenuetab{
	padding: 5px;
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
	.insertion{
		border: 1px solid black;
		width: 25%;
		padding-bottom: 10px;
		background-color: white;
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
	</style>
