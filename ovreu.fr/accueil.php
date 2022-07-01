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
<html>
  <head>
    <meta charset="utf-8">
    <title>Accueil</title>
   <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	  
  </head>
  <body>
    

    <div class="navbar">
      <ul class="tabs group">
	      <li class="inser_reu"><a href="reunions_inser.php">GÉRER LES RÉUNIONS</a></li>
	      <li><a href="reunions_consult.php">DATES CALCULÉES</a></li>
		<li><a href="reunions_month.php">RÉUNIONS DU MOIS</a></li>  
        <li><a href="salarie.php">GÉRER LES SALARIÉS</a></li> 
        <li class="active"><a href="accueil.php">ACCUEIL</a></li>
  	  </ul>
      <a class="logout" href="logout.php"><img src="images/logout.png" alt="" width="23px" height="23px"></a>
    </div>
    <center>
    <div class="logo">
      <img src="images/OVlogosf.png" alt="" height="180px">
    </div>
      


    <div class="red">

    </div>

       
    </center>
  </body>
</html>
















<!-- ///////////////////////////////////////////////////////////////////////////////////////////-->
<!-- ////////////////////////////////////////////CSS////////////////////////////////////////////-->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////-->
<style>
@import url('https://fonts.googleapis.com/css2?family=Gothic+A1:wght@600&display=swap');
html,body{
overflow-x:hidden;
overflow-y:hidden;
}
body{
  position:relative;
  margin: 0px;
  padding: 0px;
  background-color: #EBEBEB;
  transition-duration: 0.7s;
}

a, a:visited, a:hover, a:active {
  color: inherit;
  text-decoration: none;
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
.red{
margin:0;
 width: 93%;
 height: 110%;
 position: fixed;
 bottom: 0px;
 clip-path: polygon(0 25%, 42% 61%, 88% 100%, 0% 100%);
 background: linear-gradient(110deg, rgba(255, 37, 82,1) 50%, rgba(214, 39, 76,1) 50%);
 z-index: -1;
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
  margin-right: 4%;
}
.logo{
  margin-top: 7%;
}

    .tabs { 
    	list-style: none;
	width:100%; 
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
