<?php
include_once("Profil.class.php");
class Profil_line extends Profil
  {
     private $user_id;
     private $contenu;
     private $date_profil;

     public function __construct($user_id,$contenu,$date_profil)
       {   
           
           if(is_int($user_id))
              {
                $this->user_id=$user_id;
              }
          if(is_string($contenu))
             {
                $this->contenu=$contenu;
             }
          if(is_string($date_profil))
             {
                $this->date_profil=$date_profil;
             }
             
        }
    //creation des setteur
    public function setuser_id($user_id)     
        {
          if(is_string($user_id))
            {
              $this->user_id=$user_id;
            }
        }
    
    public function setcontenu($contenu)      
       {
            if(is_string($contenu))
            {
              $this->contenu=$contenu;
            }
       }
    public function setdate_profil($date_profil)   
       {
        if(is_string($date_profil))
         {
          $this->date_profil=$date_profil;
         }
       }
    
    //creation des getteur
    public function getuser_id()      {return $this->user_id;}
    public function getcontenu()      {return $this->contenu;}
    public function getdate_profil()  {return $this->date_profil;}
    
  }