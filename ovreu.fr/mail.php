#!/usr/bin/php -q
<?php
try
{
  // On se connecte à MySQL
  $mysqlClient = new PDO('mysql:host=localhost;dbname=ReunionOV;charset=utf8', 'ov_rh_managment', 'Openvalue75!');
}
catch(Exception $e)
{
  // En cas d'erreur, on affiche un message et on arrête tout
  die('Erreur : '.$e->getMessage());
}
// Si tout va bien, on peut continuer

$sqlQuery = 'SELECT month(curdate());';
$recipesStatement = $mysqlClient->prepare($sqlQuery);
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();

// On affiche chaque recette une à une
foreach ($recipes as $recipe) 
{
//date de départ
$curmois = $recipe['month(curdate())'];
//Récupérer l'id salarie FIN/////////////////////////////////////////
}
if ($curmois == 12){ //Décembre
  $requete = 'select s.nom,s.prenom, r.libelle from Salarie s, Reunion r where s.idsalarie=r.idsalarie and month(datereunion) = 1 and year(datereunion) = year(curdate())+1;';
  $result = $mysqlClient->query($requete);

  
  //print_r($finalresult);

  //$stmt = $mysqlClient->query($sqlQuery);
  
  //if($stmt === false){
  //  die("erreur");
  //}

  $message = "";
  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $message = $message ." \n ". $row['prenom'] ."  ". $row['nom'] ." | ". $row['libelle'] ." \n " ;
  
    echo '<br>';
  }
  $message = "Bonjour Christina, \nvoici les réunions que tu dois prévoir dans le mois : \n". ' '.$message;

  $subject="TEST envoi mail";
  $to = 'dragonlex4@gmail.com';
  $headers = "Content-Type: text/plain; charset=utf-8\r\n";
 // $headers .= "From: koceila.barchiche@openvalue.fr\r\n";

  if(mail($to,$subject,$message,$headers)){
  echo"Un mail vient d'être envoyé à la personne concernée";
  }else{
     echo "Erreur : Le mail ne s'est pas envoyé";
  }

}else{
  //tous les mois sauf décembre
  $requete = 'select s.nom,s.prenom, r.libelle from Salarie s, Reunion r where s.idsalarie=r.idsalarie and month(datereunion) = month(curdate())+1 and year(datereunion) = year(curdate());';
  $result = $mysqlClient->query($requete);

  
  //print_r($finalresult);

  //$stmt = $mysqlClient->query($sqlQuery);
  
  //if($stmt === false){
  //  die("erreur");
  //}

  $message = "";
  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $message = $message ." \n ". $row['prenom'] ."  ". $row['nom'] ."  ". $row['libelle'] ."\n" ;
    //echo htmlspecialchars($row['nom']."  ");
    //echo htmlspecialchars($row['prenom']." - ");
    //echo htmlspecialchars($row['libelle']);
  }

  $subject="TEST envoi mail";
  $to = 'dragonlex4@icloud.com';
  $headers = "Content-Type: text/plain; charset=utf-8\r\n";
 // $headers .= "From: clientmabanque442@gmail.com\r\n";

  if(mail($to,$subject,$message,$headers)){
  echo"Un mail vient d'être envoyé à la personne concernée";
  }else{
     echo "Erreur : Le mail ne s'est pas envoyé";
  }
}
?>

