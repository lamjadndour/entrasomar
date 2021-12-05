<?php

require_once('../config/facture.php');


if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit();
      

  }

}elseif(!isset($_SESSION["admin"])){
  header("location: ../index.php");
  exit();

}




$facture = new facture();
$data = $facture->displayFacture();
?>




<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
            <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">
                <?php
                if(isset($_GET["error"])){
                    $error =$_GET["error"];
                        if($error == "success"){
                            echo "<div class='alert alert-success alert-dismissible fade show messages' role='alert'>
                            <span>The operation completed successfully</span>  
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
                        }else{

                            echo "<div class='alert alert-danger alert-dismissible fade show messages' role='alert'>
                            <span>The operation was not completed successfully</span>  
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>"; }
      
                }
                
                ?>
                <h3 class="text-center mb-5 bien">Afficher Facture</h3>
       
        <!-- Datatable -->
        
       <?php 
       if($data){
       ?>
        <table class="table table-bordered mb-5" id="myTable">
            <thead>
                <tr class="table-success">
                <tr class="table-success">
                <th scope="col">avance</th>
                <th scope="col">total</th>
                <th scope="col">prix final</th>
                <th scope="col">rest a payer</th>
                <th scope="col">status</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $row): ?>
                <tr>
              
                <td><?php echo $row['avance'] ?>DH</td>
                <td><?php echo $row['total'] ?> DH</td>
                <td><?php echo $row['remise']?> DH </td>
                <td><?php echo $row['reste'] ?> DH</td>
                <td><?php echo $row['status'] ?></td>
                <td> <button class="btn btn-success mx-auto"><a href="editFacture.php?id-facture=<?php echo $row['id-facture']?>&id-mission=<?php echo $row['id-mission'] ?>">Ajouter Avance</a></button>
                <button class="btn btn-info  mx-auto"><a href="imprimerFacture.php?id-mission=<?php echo $row['id-mission'] ?>">Afficher</a></button>
                 </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       <?php }else{ ?>

        <div class="alert alert-warning" role="alert">
          There is no invoice!
        </div>

       <?php }?>

        
     <!--------------------------------------- END  show all users and admins ---------------------------------->


                </div>
            </main>

           <!--------------------------------------- START Container---------------------------------->

        </div>
    </div>
    <?php require_once('../includes/script.php'); ?>


</body>

</html>