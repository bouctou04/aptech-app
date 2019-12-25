<?php
class Forum
  {
     private $id_forum;
     private $user_id;
     private $sujet;
     private $contenu;
     private $like;
     //constructeur
     public function __construct($id_forum,$user_id,$sujet,$contenu,$like)
       {   
           if(is_int($id_forum))
              {
                $this->id_forum=$id_forum;
              }
           if(is_int($user_id))
              {
                $this->user_id=$user_id;
              }
          if(is_string($sujet))
              {
                $this->sujet=$sujet;
              }
          if(is_string($contenu))
             {
                $this->contenu=$contenu;
             }
          if(is_int($like))
             {
                $this->like=$like;
             }
            
        }
    //creation des setteur
    public function setid_forum($id_forum)            
       {
         if(is_int($id_forum))
           {
             $this->id_forum=$id_forum;
           }
       }
    public function setuser_id($user_id)     
        {
          if(is_int($user_id))
            {
              $this->user_id=$user_id;
            }
        }
    public function setsujet($sujet)  
       {
          if(is_string($sujet))
              {
                $this->sujet=$sujet;
              }
       }
    public function setcontenu($contenu)      
       {
            if(is_string($contenu))
            {
              $this->contenu=$contenu;
            }
       }
    public function setlike($like)   
       {
        if(is_int($like))
         {
          $this->like=$like;
         }
       }
   
    //creation des getteur
    public function getid_forum()           {return $this->id_forum;}
    public function getuser_id()     {return $this->user_id;}
    public function getsujet() {return $this->sujet;}
    public function getcontenu()     {return $this->contenu;}
    public function getlike()  {return $this->like;}
    
  }