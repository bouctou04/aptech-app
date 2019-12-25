<?php
class Message
  {
     protected $id_message;
     protected $user_id;
     protected $contenu;
     protected $date_message;
     //constructeur
     public function __construct($id_message,$user_id,$contenu,$date_message)
       {   
          if(is_int($id_message))
            {
              $this->id_message=$id_message;
            }
          if(is_int($user_id))
            {
                $this->user_id=$user_id;
            }
          if(is_string($contenu))
            {
                $this->contenu=$contenu;
            }
           
          if(is_string($date_message))
            {
                $this->date_message=$date_message;
            }
         
        }
    //creation des setteur
    public function setid_message($id_message)            
     {
      if(is_int($id_message))
        {
          $this->id_message=$id_message;
        }
     }
    public function setuser_id($user_id)            
     {
       if(is_int($user_id))
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
    
    public function setdate_message($date_message)  
       {
          if(is_string($date_message))
            {
              $this->date_message=$date_message;
            }
       }
    
    //creation des getteur
    public function getid_message()           {return $this->id_message;}
    public function getuser_id()           {return $this->user_id;}
    public function getcontenu()           {return $this->contenu;}
    public function getdate_message() {return $this->date_message;}
    
  }