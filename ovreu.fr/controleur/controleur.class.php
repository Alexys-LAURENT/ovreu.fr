<?php
  require_once("modele/modele.class.php");

  class Controleur{

    private $unModele;

    public function __construct()
    {
      $this->unModele = new Modele();
    }

    //Clients 

    public function insertClient($tab)
    {
      //on contrôle les données avant insertion dans le modele
      $this->unModele->insertClient($tab);
    }
    public function selectAllClients()
    {
        return $this->unModele->selectAllClients();
    }
    public function modifyClient($tab)
    {
        return $this->unModele->modifyClient($tab);
    }
   public function selectOneClient($idsalarie)
    {
        return $this->unModele->selectOneClient($idsalarie);
    } 



   
    //Interventions

    public function insertIntervention($tab)
    {
      //on contrôle les données avant insertion dans le modele
      $this->unModele->insertIntervention($tab);
    }

   public function insertInterventionvalide($tab)
    {
      //on contrôle les données avant insertion dans le modele
      $this->unModele->insertInterventionvalide($tab);
    }
    public function selectAllInterventions()
    {
        return $this->unModele->selectAllInterventions();
    }
	
    public function selectAllInterventionsmonth()
    {
        return $this->unModele->selectAllInterventionsmonth();
    }
    
   public function selectAllInterventionsValide()
    {
        return $this->unModele->selectAllInterventionsValide();
    }

    public function deleteReunionValide($tabrv)
    {
      //on contrôle les données avant insertion dans le modele
      $this->unModele->deleteReunionValide ($tabrv);
    }
    public function deleteAllInterventions($tab)
    {
        return $this->unModele->deleteAllInterventions($tab);
    }

    
    public function inser_tech2()
    {
      //on contrôle les données avant insertion dans le modele
      $this->unModele->inser_tech2();
    }
    public function inser_tech2bis($tab)
    {
      //on contrôle les données avant insertion dans le modele
      $this->unModele->inser_tech2bis($tab);
    }
    
    public function inser_tech1()
    {
      //on contrôle les données avant insertion dans le modele
      $this->unModele->inser_tech1();
    }
    public function inser_tech1bis($tab)
    {
      //on contrôle les données avant insertion dans le modele
      $this->unModele->inser_tech1bis($tab);
    }
    
    public function inser_reu_michel()
    {
      //on contrôle les données avant insertion dans le modele
      $this->unModele->inser_reu_michel();
    }
    public function inser_reu_michelbis($tab)
    {
      //on contrôle les données avant insertion dans le modele
      $this->unModele->inser_reu_michelbis($tab);
    }

    public function inser_reu_guillaume()
    {
      //on contrôle les données avant insertion dans le modele
      $this->unModele->inser_reu_guillaume();
    }
    public function inser_reu_guillaumebis($tab)
    {
      //on contrôle les données avant insertion dans le modele
      $this->unModele->inser_reu_guillaumebis($tab);
    }





                    
    public function deleteClient ($idclient)
    {
      //on contrôle les données avant insertion dans le modele
      $this->unModele->deleteClient ($idclient);
    }
    

  }
?>
