<?php
class Abonnement
  {
     private $id_abon;
     private $user2_id;
     private $user_id;
     private $conf;
     private $date_abon;

     public function __construct($id_abon,$user2_id,$user_id,$conf,$date_abon)
       {   
           if(is_int($id_abon))
              {
                $this->id_abon=$id_abon;
              }
           if(is_int($user2_id))
              {
                $this->user2_id=$user2_id;
              }
          if(is_int($user_id))
              {
                $this->user_id=$user_id;
              }
          if(is_int($conf))
             {
                $this->conf=$conf;
             }
        if(is_string($date_abon))
             {
                $this->date_abon=$date_abon;
             }
        }
    //creation des setteur
    public function setid_abon($id_abon)            
       {
         if(is_int($id_abon))
           {
             $this->id_abon=$id_abon;
           }
       }
    public function setuser2_id($user2_id)     
        {
          if(is_int($user2_id))
            {
              $this->user2_id=$user2_id;
            }
        }
    public function setuser_id($user_id)  
       {
          if(is_int($user_id))
              {
                $this->user_id=$user_id;
              }
       }
    public function setconf($conf)      
       {
            if(is_int($conf))
            {
              $this->conf=$conf;
            }
       }
    public function setdate_abon($date_abon) 
       {
        if(is_string($date_abon))
         {
          $this->date_abon=$date_abon;
         }
       }
    //creation des getteur
    public function getid_abon()           {return $this->id_abon;}
    public function getuser2_id()   {return $this->user2_id;}
    public function getuser_id() {return $this->user_id;}
    public function getconf()     {return $this->conf;}
    public function getdate_abon() {return $this->date_abon;}

  }