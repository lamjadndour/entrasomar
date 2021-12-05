<?php


require_once('../config/sups.php');
require_once('../config/sup.php');


  
if(!isset($_SESSION["admin"] )){
     
    if(!isset($_SESSION["user"]) ){
        header("location: ../index.php");
        exit;

    }

}elseif(!isset($_SESSION["admin"])){
    header("location: ../index.php");
    exit;

}

 
$suprv = new Suprv();
 $suprv->addSup();

 $displaySup = new Sup(); //create a object
 $data =$displaySup ->displaySup();
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
    </div>";        }
        

    
  }
 
 ?>


                      <!--------------------------------------- END print message ---------------------------------->



                         <!--------------------------------------- START from ---------------------------------->
                    
<!-- <h3 class="text-center mb-5 bien">Ajouter Superviseur</h3> -->
<h3 class="text-center mb-5 bien">Ajouter Superviseur</h3>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Name Superviseur</label>
      <input type="text" name="name_sup" class="form-control" placeholder="Entrer Name Superviseur">
    </div>
    <div class="form-group col-md-6">
      <label >Phone Superviseur</label>
      <input type="text" name="phone_sup" class="form-control" placeholder="Entrer Phone Superviseur">
    </div>

    <!-- <div class="form-group col-md-6">
      <label >id mokabil</label>

      <select name="id_supp" class="form-control">
        <option selected="true" disabled="disabled" value="" >select mokabil ...</option> -->

        <?php 
          // if( $data){
          //   foreach($data as $row){ 
          //   unset($id, $name);
          //   $id = $row['id-sup'];
          //   $name = $row['name-sup']; 
          //   echo '<option value="'.$id.'">'.$name.'</option>';
          //   }
          // } 
        ?>
      <!-- </select> 
   </div> -->
  </div>
  <!-- <div class="form-row">
    <div class="form-group col-md-6">
      <label >Nom bateau</label>
      <input type="text" name="name_boat" class="form-control" placeholder="Entrer le Nom bateau">
    </div>
    <div class="form-group col-md-6">
      <label >Nom capitane</label>
      <input type="text" name="capitane_name" class="form-control" placeholder="Entrer le Nom capitane">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >type</label>
      <input type="text" name="type" class="form-control" >
    </div>
    <div class="form-group col-md-6">
      <label >N° capitane</label>
      <input type="text" name="capitane_phone" class="form-control" placeholder="Entrer N° capitane" >
    </div>
  </div> -->
  <div class="form-group">
    <label>Date</label>
    <input type="date" name="date" class="form-control" >
     </div>
  
  <button type="submit"  name="send" class="btn btn-outline-danger btn-lg d-block mx-auto ">ajouté</button>
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