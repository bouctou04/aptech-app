<?php
class Profil
  {
     private $id_profil;
     private $contenu;
     //creation du constructeur
     public function __construct($id_profil,$contenu)
       {   
           if(is_int($id_profil))
              {
                $this->id_profil=$id_profil;
              }
          
          if(is_string($contenu))
             {
                $this->contenu=$contenu;
             }
        }
    //creation des setteur
    public function setid_profil($id_profil)            
       {
         if(is_int($id_profil))
           {
             $this->id_profil=$id_profil;
           }
       }
    public function setcontenu($contenu)      
       {
            if(is_string($contenu))
            {
              $this->contenu=$contenu;
            }
       }
    
    
    //creation des getteur
    public function getid_profil()     {return $this->id_profil;}
    public function getcontenu()     {return $this->contenu;}
    
  }