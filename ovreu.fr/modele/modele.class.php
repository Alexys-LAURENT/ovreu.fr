*<?php
  class Modele
  {
    private $unPdo = null;
    //PDO: classe en php pour se connecter à la base de données; P:PHP, D:Data, O:Object

    public function __construct ()
    {
      try{
        //gestion des exceptions: code qui pourra poser des problemes de connexion
        $this->unPdo= new PDO("mysql:host=localhost;dbname=ReunionOV","ov_rh_managment","Openvalue75!");
      }
      catch(PDOException $exp)
      {
        //la levée de l'exception: on affiche un message
        echo " <div class='error'> <p>Erreur de connexion à la base de données</p>";
        echo "".$exp->getMessage()."</div>";
      }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////Fonction pour insérer un salarie//////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function insertClient($tab)
    {
      if($tab['nom'] == null or $tab['prenom'] == null or $tab['email'] == null or $tab['dateembauche'] == null){
        echo "Désolé veuillez remplir tous les champs..";
      }else{
        $requete = "select nom,prenom from Salarie where nom=:nom and prenom=:prenom;";
        $donnees = array(":nom"=>$tab['nom'],
        ":prenom"=>$tab['prenom']
        );
        if($this->unPdo != null){
          //on prépare la requête (vérifier si le salarié existe déjà)
          $select = $this->unPdo->prepare($requete);
          //on exécute la requête
          $select->execute($donnees);
          $result = $select->fetchall();
          $count= count($result);
          if ($count > 0){ //Si il exite :
            echo "Désole ce salarié est déjà enregistré dans le base de données";
          }else{ //Si il n'existe pas :
            $requete = "insert into Salarie values(null, :nom, :prenom, :email, :dateembauche);";
            $donnees = array(":nom"=>$tab['nom'],
            ":prenom"=>$tab['prenom'],
            ":email"=>$tab['email'],
            ":dateembauche"=>$tab['dateembauche']
            );
  
            if($this->unPdo != null){
              //on prépare la requête
              $select = $this->unPdo->prepare($requete);
              //on exécute la requête
              $select->execute($donnees);
            }else{
              return null;
            }
  
  
          }
        }else{
          return null;
        }
      }
     
  
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////Fonction pour afficher les salaries///////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function selectAllClients()
    {
      $requete = "select idsalarie,nom,prenom,email,date_format(dateembauche,'%D %b %Y') from Salarie order by dateembauche desc;";
      if($this->unPdo != null){
        //on prépare la requête
        $select = $this->unPdo->prepare($requete);
        //on exécute la requête
        $select->execute();
        //on récupère les salariés et on les renvoient
        return $select->fetchAll();
      }else{
        return null;
      }
    }

	
   ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////Fonction pour afficher le client entrain d'être modifier///////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function selectOneClient($idsalarie)
    {
      $requete = "select nom,prenom,email,date_format(dateembauche,'%D %b %Y') from Salarie where idsalarie = :idsalarie;";
      $donnees = array(
            ":idsalarie"=>$idsalarie
            );
      if($this->unPdo != null){
        //on prépare la requête
        $select = $this->unPdo->prepare($requete);
        //on exécute la requête
        $select->execute($donnees);
        //on récupère les salariés et on les renvoient
        return $select->fetchAll();
      }else{
        return null;
      }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////Fonction pour modifier les salaries///////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function modifyClient($tab)
    {
      $requete = "update Salarie set nom=:nom, prenom=:prenom, email=:email, dateembauche=:dateembauche where idsalarie=:idsalarie;";
      $donnees = array(":nom"=>$tab['nom'],
      ":idsalarie"=>$tab['idsalarie'],
      ":prenom"=>$tab['prenom'],
      ":email"=>$tab['email'],
      ":dateembauche"=>$tab['dateembauche']
      );
      if($this->unPdo != null){ //si il y bien la connexion avec la bdd:
        //on prépare la requête
        $select = $this->unPdo->prepare($requete);
        //on exécute la requête
        $select->execute($donnees);
      }else{
        return null;
      }
    }



    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////Fonction pour saisir une réunion//////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function insertIntervention($tab)
    {
      $requete = "insert into Reunion values(null, :datereunion, :heure, :libelle, :idsalarie);";
      $donnees = array(":datereunion"=>$tab['datereunion'],
      ":heure"=>$tab['heure'],
      ":libelle"=>$tab['libelle'],
      ":idsalarie"=>$tab['idsalarie']
      );
      if($this->unPdo != null) //si il y bien la connexion avec la bdd:
      {
        //on prépare la requête
        $select = $this->unPdo->prepare($requete);
        //on exécute la requête
        $select->execute($donnees);

      }else{
        return null;
      }
    }
   

   ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////Fonction pour saisir une réunion planifiée//////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function insertInterventionvalide($tab)
    {
      $idsalarie = $tab['idsalarie'];
      $date = $tab['datereunion'];
      $heure = $tab['heurereunion'];
      $libelle = $tab['libelle'];
      $date2 = strtotime($date);
      $date3 = date('Y-m-d',$date2);
      $requete = "insert into ReunionValide values(null, '{$date3}','{$heure}', '{$libelle}', '{$idsalarie}');";
      if($this->unPdo != null) //si il y bien la connexion avec la bdd:
      {
        //on prépare la requête
        $select = $this->unPdo->prepare($requete);
        //on exécute la requête
        $select->execute();

      }else{
        return null;
      }
    }


	public function deleteReunionValide ($tabrv)
	{
    $idsalarie = $tabrv['idsalarie'];
    $heurereunionvalide = $tabrv['heurereunionvalide'];
    $date = $tabrv['datereunionvalide'];
    $date2 = strtotime($date);
    $date3 = date('Y-m-d',$date2);
   
		$requete = "delete from ReunionValide where idsalarie ='".$idsalarie."' and heurereunion ='".$heurereunionvalide."' and datereunion ='".$date3."';";
		$con = mysqli_connect("localhost", "ov_rh_managment", "Openvalue75!", "ReunionOV");
		mysqli_query($con, $requete);
		mysqli_close($con);
	}
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////Fonction pour afficher les réunions///////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function selectAllInterventions()
    {
      $requete = "select r.idreunion,s.nom,s.prenom,r.libelle,date_format(r.datereunion, '%D %b %Y') from Salarie s, Reunion r where s.idsalarie=r.idsalarie ORDER BY datereunion ASC ;";
      if($this->unPdo != null){  //si il y bien la connexion avec la bdd:
        //on prépare la requête
        $select = $this->unPdo->prepare($requete);
        //on exécute la requête
        $select->execute();
        //on récupère les interventions et on les renvoient
        return $select->fetchAll();
      }else{
        return null;
      }
    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////Fonction pour afficher les réunions///////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function selectAllInterventionsValide()
    {
      $requete = "select s.idsalarie,s.nom,s.prenom,rv.libelle,date_format(rv.datereunion, '%D %b %Y'),rv.heurereunion from Salarie s, ReunionValide rv where s.idsalarie=rv.idsalarie ORDER BY datereunion ASC ;";
      if($this->unPdo != null){  //si il y bien la connexion avec la bdd:
        //on prépare la requête
        $select = $this->unPdo->prepare($requete);
        //on exécute la requête
        $select->execute();
        //on récupère les interventions et on les renvoient
        return $select->fetchAll();
      }else{
        return null;
      }
    }
        

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////Fonction pour afficher les réunions du mois///////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function selectAllInterventionsmonth()
    {
      $requete = "select r.idreunion,s.nom,s.prenom,r.libelle,date_format(r.datereunion, '%D %b %Y') from Salarie s, Reunion r where s.idsalarie=r.idsalarie and month(datereunion)=month(curdate()) and year(datereunion)=year(curdate()) ORDER BY datereunion ASC ;";
      if($this->unPdo != null){  //si il y bien la connexion avec la bdd:
        //on prépare la requête
        $select = $this->unPdo->prepare($requete);
        //on exécute la requête
        $select->execute();
        //on récupère les interventions et on les renvoient
        $tab1 = $select->fetchAll();
       // return $select->fetchAll();


	$requete ="SELECT month(curdate())";
        $select = $this->unPdo->prepare($requete);
        $select->execute();
        $sels = $select->fetchAll();

        foreach ($sels as $sel){
          $curmois = $sel['month(curdate())'];
        }

	if ($curmois == 12){
	$requete = "select r.idreunion,s.nom,s.prenom,r.libelle,date_format(r.datereunion, '%D %b %Y') from Salarie s, Reunion r where s.idsalarie=r.idsalarie and month(datereunion)=1 and year(datereunion)=year(curdate())+1 and day(datereunion) < 14 ORDER BY datereunion ASC ;";
	$select = $this->unPdo->prepare($requete);
	$select ->execute();
	$tab2 = $select->fetchAll();
	$tab3 = array_merge($tab1,$tab2);
	return $tab3;
	}else{
        $requete = "select r.idreunion,s.nom,s.prenom,r.libelle,date_format(r.datereunion, '%D %b %Y') from Salarie s, Reunion r where s.idsalarie=r.idsalarie and month(datereunion)=month(curdate())+1 and year(datereunion)=year(curdate()) and day(datereunion) < 14 ORDER BY datereunion ASC ;";
        $select = $this->unPdo->prepare($requete);
        $select->execute();
        $tab2 = $select->fetchAll();
	$tab3 = array_merge($tab1,$tab2);
        return $tab3;
	}
      }else{
        return null;
      }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////Fonction pour supprimer ttes les réunions lors d'une modification de la date d'entrée d'un salarié////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function deleteAllInterventions($tab)
    {
      $requete = "delete from Reunion where idsalarie=:idsalarie;";
      $donnees = array(":idsalarie"=>$tab['idsalarie']);
      if($this->unPdo != null){  //si il y bien la connexion avec la bdd:
        //on prépare la requête
        $select = $this->unPdo->prepare($requete);
        //on exécute la requête
        $select->execute($donnees);
      }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////Fonction pour entretien technique 2///////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Fonction qui insert dans une table (reunions) plusieurs reunions pour l'entretien technique n°2. 
    
    public function inser_tech2()
    {
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

      // On récupère la date d'embauche du salarié qui vient d'être inséré
      $sqlQuery = 'SELECT dateembauche FROM Salarie where idsalarie=(select max(idsalarie) from Salarie);';
      $recipesStatement = $mysqlClient->prepare($sqlQuery);
      $recipesStatement->execute();
      $recipes = $recipesStatement->fetchAll();

      // On affiche chaque recette une à une
      foreach ($recipes as $recipe) 
      {
        //date de départ
        $dateembauchephp = $recipe['dateembauche'];
      }


      //Récupérer l'id salarie :
      $sqlQuery = 'SELECT idsalarie FROM Salarie where idsalarie=(select max(idsalarie) from Salarie);';
      $recipesStatement = $mysqlClient->prepare($sqlQuery);
      $recipesStatement->execute();
      $recipes = $recipesStatement->fetchAll();

      // On affiche chaque recette une à une
      foreach ($recipes as $recipe) 
      {
        //id du salarié
       $iddusalarie = $recipe['idsalarie'];
      }

      for ($i = 1; $i <= 20; $i++) { //On va générer des dates sur 20ans :
        $dateFin = date("Y-m-d",strtotime($dateembauchephp.'+'.$i.' year'));


        //Essaie d'inserer dans la BDD des dates futur qui seront à checker et à rapeller par mail
        
        $req=$mysqlClient->prepare("insert into Reunion (datereunion,libelle,idsalarie) values ('{$dateFin}','Entretien technique numero 2 ','{$iddusalarie}');");
        $req->execute();


      }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////Fonction pour entretien technique 1//////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function inser_tech1()
    {
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

      //  On récupère la date d'embauche du salarié qui vient d'être inséré
      $sqlQuery = 'SELECT dateembauche FROM Salarie where idsalarie=(select max(idsalarie) from Salarie);';
      $recipesStatement = $mysqlClient->prepare($sqlQuery);
      $recipesStatement->execute();
      $recipes = $recipesStatement->fetchAll();

      // On affiche chaque recette une à une
      foreach ($recipes as $recipe) 
      {
        //date d'embauche
        $dateembauchephp = $recipe['dateembauche'];
      }


      //Récupérer l'id salarie :
      $sqlQuery = 'SELECT idsalarie FROM Salarie where idsalarie=(select max(idsalarie) from Salarie);';
      $recipesStatement = $mysqlClient->prepare($sqlQuery);
      $recipesStatement->execute();
      $recipes = $recipesStatement->fetchAll();

      // On affiche chaque recette une à une
      foreach ($recipes as $recipe) 
      {
        //id du salarié
       $iddusalarie = $recipe['idsalarie'];
      }
      $dateFin = date("Y-m-d",strtotime($dateembauchephp.'+ 6 month')); //On ajoute +6 mois à la date d'embauche et on l'insert
      $req=$mysqlClient->prepare("insert into Reunion (datereunion,libelle,idsalarie) values ('{$dateFin}','Entretien technique numero 1 ','{$iddusalarie}');");
      $req->execute();
      for ($i = 1; $i <= 20; $i++) { //Puis on l'insert de nouveaux sur 20 ans de +
        $datet1 = date("Y-m-d",strtotime($dateFin.'+'.$i.' year'));


        //Essaie d'inserer dans la BDD des dates futur qui seront à vérifier et à rapeller par mail dans "mail.php"
        
        $req=$mysqlClient->prepare("insert into Reunion (datereunion,libelle,idsalarie) values ('{$datet1}','Entretien technique numero 1 ','{$iddusalarie}');");
        $req->execute();


      }
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////Fonction pour entretien avec Michel//////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function inser_reu_michel()
    {
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

      // On récupère la date d'embauche du salarié qui vient d'être inséré
      $sqlQuery = 'SELECT dateembauche FROM Salarie where idsalarie=(select max(idsalarie) from Salarie);';
      $recipesStatement = $mysqlClient->prepare($sqlQuery);
      $recipesStatement->execute();
      $recipes = $recipesStatement->fetchAll();

      // On affiche chaque recette une à une
      foreach ($recipes as $recipe) 
      {
        //date d'embauche
        $dateembauchephp = $recipe['dateembauche'];
      }


      //Récupérer l'id salarie :
      $sqlQuery = 'SELECT idsalarie FROM Salarie where idsalarie=(select max(idsalarie) from Salarie);';
      $recipesStatement = $mysqlClient->prepare($sqlQuery);
      $recipesStatement->execute();
      $recipes = $recipesStatement->fetchAll();

      // On affiche chaque recette une à une
      foreach ($recipes as $recipe) 
      {
        //id du salarié
       $iddusalarie = $recipe['idsalarie'];
      }
      $dateFin = date("Y-m-d",strtotime($dateembauchephp.'+ 1 month'));
      for ($i = 1; $i <= 20; $i++) {
        $datet1 = date("Y-m-d",strtotime($dateFin.'+'.$i.' year'));


        //Essaie d'inserer dans la BDD des dates futur qui seront à checker et à rapeller par mail
        
        $req=$mysqlClient->prepare("insert into Reunion (datereunion,libelle,idsalarie) values ('{$datet1}','Entretien avec Michel ','{$iddusalarie}');");
        $req->execute();


      }
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////Fonction pour entretien avec Guillaume///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function inser_reu_guillaume()
    {
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

      // On récupère la date d'embauche du salarié qui vient d'être inséré
      $sqlQuery = 'SELECT dateembauche FROM Salarie where idsalarie=(select max(idsalarie) from Salarie);';
      $recipesStatement = $mysqlClient->prepare($sqlQuery);
      $recipesStatement->execute();
      $recipes = $recipesStatement->fetchAll();

      // On affiche chaque recette une à une
      foreach ($recipes as $recipe) 
      {
        //date d'embauche
        $dateembauchephp = $recipe['dateembauche'];
      }


      //Récupérer l'id salarie :
      $sqlQuery = 'SELECT idsalarie FROM Salarie where idsalarie=(select max(idsalarie) from Salarie);';
      $recipesStatement = $mysqlClient->prepare($sqlQuery);
      $recipesStatement->execute();
      $recipes = $recipesStatement->fetchAll();

      // On affiche chaque recette une à une
      foreach ($recipes as $recipe) 
      {
        //id du salarié
       $iddusalarie = $recipe['idsalarie'];
      }
      $dateFin = date("Y-m-d",strtotime($dateembauchephp.'+ 2 month')); //On ajoute 2 mois mais on ne l'insert pas
      for ($i = 1; $i <= 20; $i++) {
        $datet1 = date("Y-m-d",strtotime($dateFin.'+'.$i.' year')); //Puis on l'insert avec les 2mois en + sur 20ans.


        //Essaie d'inserer dans la BDD des dates futur qui seront à checker et à rapeller par mail
        
        $req=$mysqlClient->prepare("insert into Reunion (datereunion,libelle,idsalarie) values ('{$datet1}','Entretien avec Guillaume ','{$iddusalarie}');");
        $req->execute();


      }
    }
    

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////Fonction pour entretien technique 2BIS///////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Fonction qui insert dans une table de bdd (reunions) plusieurs reunions pour l'entretien technique n°2 si le salarié est modifié. Pour tenir les dates correctes si modif. 
    
    public function inser_tech2bis($tab)
    {
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

      // On récupère la date d'embauche du salarié qui vient d'être modifié
      $dateembauchephp=$tab['dateembauche'];


      //Récupérer l'id salarie :
      $iddusalarie=$tab['idsalarie'];

      for ($i = 1; $i <= 20; $i++) { //Même procédure que dans la fonction insert_tech2 :
        $dateFin = date("Y-m-d",strtotime($dateembauchephp.'+'.$i.' year'));


        //Essaie d'inserer dans la BDD des dates futur qui seront à checker et à rapeller par mail
        
        $req=$mysqlClient->prepare("insert into Reunion (datereunion,libelle,idsalarie) values ('{$dateFin}','Entretien technique numero 2 ','{$iddusalarie}');");
        $req->execute();


      }
    }



    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////Fonction pour entretien technique 1BIS//////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Fonction qui insert dans une table de bdd (reunions) plusieurs reunions pour l'entretien technique n°1 si le salarié est modifié. Pour tenir les dates correctes si modif. 

    public function inser_tech1bis($tab)
    {
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

      // On récupère la date d'embauche du salarié qui vient d'être modifié
      $dateembauchephp=$tab['dateembauche'];

      //Récupérer l'id salarie :
      $iddusalarie=$tab['idsalarie'];

      $dateFin = date("Y-m-d",strtotime($dateembauchephp.'+ 6 month')); //Même procédure que dans la fonction insert_tech1 :
      $req=$mysqlClient->prepare("insert into Reunion (datereunion,libelle,idsalarie) values ('{$dateFin}','Entretien technique numero 1 ','{$iddusalarie}');");
      $req->execute();
      for ($i = 1; $i <= 20; $i++) {
        $datet1 = date("Y-m-d",strtotime($dateFin.'+'.$i.' year'));


        //Essaie d'inserer dans la BDD des dates futur qui seront à checker et à rapeller par mail
        
        $req=$mysqlClient->prepare("insert into Reunion (datereunion,libelle,idsalarie) values ('{$datet1}','Entretien technique numero 1 ','{$iddusalarie}');");
        $req->execute();


      }
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////Fonction pour entretien avec Michel BIS//////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Fonction qui insert dans une table de bdd (reunions) plusieurs reunions pour l'entretien technique avec Michel si le salarié est modifié. Pour tenir les dates correctes si modif. 

    public function inser_reu_michelbis($tab)
    {
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

      // On récupère la date d'embauche du salarié qui vient d'être modifé
      $dateembauchephp=$tab['dateembauche'];

      //Récupérer l'id salarie :
      $iddusalarie=$tab['idsalarie'];

      $dateFin = date("Y-m-d",strtotime($dateembauchephp.'+ 1 month')); //Même procédure que dans la fonction inser_reu_michel :
      for ($i = 1; $i <= 20; $i++) {
        $datet1 = date("Y-m-d",strtotime($dateFin.'+'.$i.' year'));


        //Essaie d'inserer dans la BDD des dates futur qui seront à checker et à rapeller par mail
        
        $req=$mysqlClient->prepare("insert into Reunion (datereunion,libelle,idsalarie) values ('{$datet1}','Entretien avec Michel ','{$iddusalarie}');");
        $req->execute();


      }
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////Fonction pour entretien avec Guillaume BIS///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Fonction qui insert dans une table de bdd (reunions) plusieurs reunions pour l'entretien technique avec Guillaume si le salarié est modifié. Pour tenir les dates correctes si modif. 

    public function inser_reu_guillaumebis($tab)
    {
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

      // On récupère la date d'embauche du salarié qui vient d'être modifié
      $dateembauchephp=$tab['dateembauche'];

      //Récupérer l'id salarie :
      $iddusalarie=$tab['idsalarie'];

      $dateFin = date("Y-m-d",strtotime($dateembauchephp.'+ 2 month')); //Même procédure que dans la fonction  inser_reu_guillaume :
      for ($i = 1; $i <= 20; $i++) {
        $datet1 = date("Y-m-d",strtotime($dateFin.'+'.$i.' year'));


        //Essaie d'inserer dans la BDD des dates futur qui seront à checker et à rapeller par mail
        
        $req=$mysqlClient->prepare("insert into Reunion (datereunion,libelle,idsalarie) values ('{$datet1}','Entretien avec Guillaume ','{$iddusalarie}');");
        $req->execute();


      }
    }




    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////Fonction pour la suppression d'un salarié///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function deleteClient ($idclient)
	{
		$requete = "delete from Salarie where idsalarie =".$idclient;
		$con = mysqli_connect("localhost", "ov_rh_managment", "Openvalue75!", "ReunionOV");
		mysqli_query($con, $requete);
		mysqli_close($con);
	}

  }

  
?>
