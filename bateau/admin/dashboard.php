<?php


require_once('../config/admin.php');

require_once('../config/boats.php');

  
if(!isset($_SESSION["admin"] )){
     
    if(!isset($_SESSION["user"]) ){
        header("location: ../index.php");
        exit;

    }

}elseif(!isset($_SESSION["admin"])){
    header("location: ../index.php");
    exit;

}
 
?>



<!doctype html>
<html lang="fr">

<?php 
    
    require_once('../includes/header.php');

?>




                                     <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
            <div class="row dash-row d-flex justify-content-center">
           

                <div class="container-fluid pt-5">

                <?php require_once('showMission.php'); ?>
              
         
                </div>
            </div>
            <?php
            require_once('../includes/script.php');
        ?>
     
  
</body>

</html>