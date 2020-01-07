<?php
require('../core/Database.class.php');
class Publication extends Database
  {
     private $id;
     private $user_id;
     private $sujet;
     private $contenu;
     private $img;
     private $like;
     //constructeur
     public function __construct($user_id,$sujet,$contenu)
       {   
           if(is_int($user_id)){
                $this->user_id = $user_id;
           }
           if(is_string($sujet)){
                $this->sujet = $sujet;
           }
           if(is_string($contenu)){
                $this->contenu = $contenu;
           }
        }
    //creation des setteur
    public function setid($id)            
       {
         if(is_int($id)){
             $this->id = $id;
         }
       }
    public function setuser_id($user_id)     
        {
          if(is_int($user_id)){
              $this->user_id = $user_id;
          }
        }
    public function setsujet($sujet)  
       {
         if(is_string($sujet)){
            $this->sujet = $sujet;
          }
       }
    public function setcontenu($contenu)      
       {
         if(is_string($contenu)){
            $this->contenu = $contenu;
         }
       }
    public function setlike($like)   
       {
         if(is_int($like)){
            $this->like = $like;
          }
       }
   
    //creation des getteur
    public function getid(){
       return $this->id;
    }
    public function getuser_id(){
      return $this->user_id;
    }
    public function getsujet(){
      return $this->sujet;
    }
    public function getcontenu(){
      return $this->contenu;
    }
    public function getlike(){
      return $this->like;
    }
   
  }