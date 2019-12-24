<?php
class User
  {
     private $nom;
     private $prenom;
     private $adr_mail;
     private $pseudo;
     private $password;
     private $date_birth;
   // creation du constructeur
     public function __construct($nom,$prenom,$adr_mail,$pseudo,$password,$date_birth)
       {   
           if(is_string($nom))
              {
                $this->nom=$nom;
              }
           if(is_string($prenom))
              {
                $this->prenom=$prenom;
              }
          if(is_string($adr_mail))
              {
                if(preg_match('#^[a-z0-9_.-]{2,}@gmail\.[a-z]{2,5}$#',$adr_mail))
                  {
                     $this->adr_mail=$adr_mail;
                  }
                  else{echo("adresse mail invalide ex:bouctou004@gamil.com");}
              }
          if(is_string($pseudo))
             {
                $this->pseudo=$pseudo;
             }
          if(is_string($password))
             {
                $this->password=$password;
             }
             if(is_string($date_birth))
             {
                $this->date_birth=$date_birth;
             }
        }
    //creation des setteur
    public function setnom($nom)            
       {
         if(is_string($nom))
           {
             $this->nom=$nom;
           }
       }
    public function setprenom($prenom)     
        {
          if(is_string($prenom))
            {
              $this->prenom=$prenom;
            }
        }
    public function setadr_mail($adr_mail)  
       {
          if(is_string($adr_mail))
           {
             if(preg_match('#^[a-z0-9_.-]{2,}@gmail\.[a-z]{2,5}$#',$adr_mail))
               {
                  $this->adr_mail=$adr_mail;
               }else{ echo"adresse mail invalide ex:bouctou004@gamil.com";}
           }
       }
    public function setpseudo($pseudo)      
       {
            if(is_string($pseudo))
            {
              $this->pseudo=$pseudo;
            }
       }
    public function setpassword($password)   
       {
        if(is_string($password))
         {
          $this->password=$password;
         }
       }
    public function setdate_birth($date_birth) 
       {
        if(is_string($date_birth))
         {
          $this->date_birth=$date_birth;
         }
       }
    //creation des getteur
    public function getnom()           {return $this->nom;}
    public function getprenom()     {return $this->prenom;}
    public function getadr_mail() {return $this->adr_mail;}
    public function getpseudo()     {return $this->pseudo;}
    public function getpassword()  {return $this->password;}
    public function getdate_birth() {return $this->date_birth;}

  }