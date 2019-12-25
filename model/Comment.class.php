<?php
class Comment
  {
     private $id_comment;
     private $user_id;
     private $forum_id;
     private $contenu;
     private $date_comment;
     private $cat_id;

     public function __construct($id_comment,$user_id,$forum_id,$contenu,$date_comment,$cat_id)
       {   
           if(is_int($id_comment))
              {
                $this->id_comment=$id_comment;
              }
           if(is_int($user_id))
              {
                $this->user_id=$user_id;
              }
          if(is_int($forum_id))
              {
                $this->forum_id=$forum_id;
              }
          if(is_string($contenu))
             {
                $this->contenu=$contenu;
             }
          if(is_string($date_comment))
             {
                $this->date_comment=$date_comment;
             }
             if(is_int($cat_id))
             {
                $this->cat_id=$cat_id;
             }
        }
    //creation des setteur
    public function setid_comment($id_comment)            
       {
         if(is_int($id_comment))
           {
             $this->id_comment=$id_comment;
           }
       }
    public function setuser_id($user_id)     
        {
          if(is_int($user_id))
            {
              $this->user_id=$user_id;
            }
        }
    public function setforum_id($forum_id)  
       {
          if(is_int($forum_id))
              {
                $this->forum_id=$forum_id;
              }
       }
    public function setcontenu($contenu)      
       {
            if(is_string($contenu))
            {
              $this->contenu=$contenu;
            }
       }
    public function setdate_comment($date_comment)   
       {
        if(is_string($date_comment))
         {
          $this->date_comment=$date_comment;
         }
       }
    public function setcat_id($cat_id) 
       {
        if(is_int($cat_id))
         {
          $this->cat_id=$cat_id;
         }
       }
    //creation des getteur
    public function getid_comment()           {return $this->id_comment;}
    public function getuser_id()     {return $this->user_id;}
    public function getforum_id() {return $this->forum_id;}
    public function getcontenu()     {return $this->contenu;}
    public function getdate_comment()  {return $this->date_comment;}
    public function getcat_id() {return $this->cat_id;}

  }