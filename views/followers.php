<?php
  
?>
<div class="col-12 col-lg-8">
       <?php  
            $user = new \Model\user();
            echo"<h4 >Les Menbres de l'Administration</h4>"."<hr>";
            $user->liste_user_admin($_SESSION['id'],$_SESSION['school_id']);
            echo"<h4 >les etudiants</h4>"."<hr>";
            $user->liste_users_student($_SESSION['id'],$_SESSION['school_id']);
            
        ?>
</div>