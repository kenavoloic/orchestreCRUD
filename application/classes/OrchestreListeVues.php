<?php

class OrchestreListeVues implements OLVInterface {

  private $whitelist = OLVInterface::whitelist;
  private $listeActions = OLVInterface::listeActions;

  //Noms des vues créées dans la base de données
  private $listeFonctionsOrchestrales = OLVInterface::listeFonctionsOrchestrales;  
  private $listeFonctionsOrchestralesIntitules = OLVInterface::listeFonctionsOrchestralesIntitules;
  private $listeRequetesSQL = OLVInterface::listeRequetesSQL;
  
  private $listeGroupes = OLVInterface::listeGroupes;
  private $listeRequetesSQLGroupes = OLVInterface::listeRequetesSQLGroupes;
  private $listeGroupesIntitules = OLVInterface::listeGroupesIntitules;

  private $dictionnaire  = OLVInterface::dictionnaire;
  private $attributsDonnees  = OLVInterface::attributsDonnees;

  private $casse = OLVInterface::casse;

  private $genres;
  private $instruments;
  private $nationalites;

  public function __construct(){
  }

  public function getWhitelist(){
    return $this->whitelist;
  }

  public function getListeFonctionsOrchestrales(){
    return $this->listeFonctionsOrchestrales;
  }

  public function getListeFonctionsOrchestralesIntitules(){
    return $this->listeFonctionsOrchestralesIntitules;
  }

  public function getListeRequetesSQL(){
    return $this->listeRequetesSQL;
  }

  public function getListeActions(){
    return $this->listeActions;
  }

  public function getListeGroupes(){
    return $this->listeGroupes;
  }

  public function getListeGroupesIntitules(){
    return $this->listeGroupesIntitules;
  }

  public function getListeRequetesSQLGroupes(){
    return $this->listeRequetesSQLGroupes;
  }

  public function validationNumeroRequete(int $nombre){
    return $nombre > count($this->listeFonctionsOrchestrales) ? 0 : $nombre;
  }

  public function getDictionnaire(){
    return $this->dictionnaire;
  }

  public function getAttributsDonnees(){
    return $this->attributsDonnees;
  }

  public function getCasse(){
    return $this->casse;
  }
  

}
