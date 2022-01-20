<?php

require_once('../config/facture.php');
require_once('../config/boats.php');
require_once('../config/mission.php');


  
if(!isset($_SESSION["admin"] )){
     
    if(!isset($_SESSION["user"]) ){
        header("location: ../index.php");
        exit;

    }

}elseif(!isset($_SESSION["admin"])){
    header("location: ../index.php");
    exit;

}

 
$facture = new Facture();
 $facture->addFacture();

 $displayBoat = new Boat(); //create a object
 $data = $displayBoat -> displayAllBoats();
?>








<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
            <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">
            <!--------------------------------------- START print message ---------------------------------->



            <div class="container-fluid">
            <!--------------------------------------- START print message ---------------------------------->

                <?php
                if(isset($_GET["error"])){
                    $error =$_GET["error"];
                        if($error == "Save it"){
                            echo "<div class='alert alert-success alert-dismissible fade show messages' role='alert'>
                            <span>$error</span>  
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
                        }else{

                            echo "<div class='alert alert-danger alert-dismissible fade show messages' role='alert'>
                            <span>$error</span>  
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>"; }
        

    
  }
 
 ?>


<div class="row">
<div class="col-md-2 productbox ">
    <div class="producttitle">Total tache</div>
    <div class="productprice"><div class="pull-right"></div>
    <div class="pricetext"><?php echo $_GET['total'] ?> DH</div></div>

</div>

</div>

<h3 class="text-center mb-5 bien">Ajouter Facture</h3>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >  
      
  <div class="form-row">

  <?php if($data) {

    foreach($data as $row){ 

    if($row['id-boat'] == $_GET['id-boat']){

    ?> 
     <input type="hidden" value="<?php echo $row['id-sup']; ?>" name="id_sup" class="form-control" >
    <?php

    }
    ?> 

    <?php } }?>
    <input type="hidden" value="<?php echo $_GET['id-boat']; ?>" name="id_boat" class="form-control" >
    <input type="hidden" value="<?php echo $_GET['id-mission']; ?>" name="id_mission" class="form-control" >
  

    <div class="form-group col-md-6">
      <label >Avance (DH)</label>
      <input type="text" class="form-control" id="avance" name="avance" value="0" min="0" placeholder="Entrer l'avance">
    </div>

    <input type="hidden" name="total" value="<?php echo $_GET['total'] ?>">
    
    <input type="hidden" id="reste" name="reste" >

    <div class="form-group col-md-6">
      <label >Prix final</label>
      <input type="text" name="remise" id="remise" class="form-control" placeholder="Entrer le Prix final" value="<?php echo $_GET['total']?>">
   </div>

  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label >status</label>
      <select name="status" class="form-control">
       <option selected="true" disabled="disabled" value="" >select Status ...</option>
       <option value="Progress">Progress</option>
       <option value="Done">Done</option>
      
    </select>
    </div>
    <div class="form-group col-md-6">
      <label >Numéro de Facture</label>
      <input type="text" name="num_facture" class="form-control" placeholder="Entrer le numéro de facture">
    </div>

  </div>

  
  <button type="submit" name="send" class="btn btn-outline-danger btn-lg d-block mx-auto" onclick="Reste()">Add Facture</button>
</form> 



     <!--------------------------------------- END from ---------------------------------->


                </div>
            </main>

           <!--------------------------------------- START Container---------------------------------->

        </div>
    </div>
    <?php
    require_once('../includes/script.php');
   ?>
</body>

</html>