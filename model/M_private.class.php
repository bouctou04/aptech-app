<?php
include_once('Message.class.php');
class M_private extends Message
  {
     private $abon_id;
     public function __construct($abon_id)
       {   
           if(is_int($abon_id))
              {
                $this->$abon_id=$abon_id;
              }
       }
    //creation des setteur
    public function setabon_id($abon_id)            
       {
         if(is_int($abon_id))
           {
             $this->$abon_id=$abon_id;
           }
       }
    
    //creation des getteur
    public function getabon_id()           {return $this->abon_id;}
    
  }