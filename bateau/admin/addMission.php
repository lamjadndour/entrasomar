<?php


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

 
$mission = new Mission();
 $mission->addMission();

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


<!--------------------------------------- END print message ---------------------------------->

<!--------------------------------------- START from ---------------------------------->
                    
<h3 class="text-center mb-5 bien"> Ajouter Mission  </h3>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        

    <div class="form-group">
      <label >le nom de Bateau</label>

      <select name="id_boat" class="form-control">
       <option selected="true" disabled="disabled" value="" >select boat ...</option>

      <?php if( $data){
      foreach($data as $row){ 
       unset($id, $name);
       $id = $row['id-boat'];
       $name = $row['name-boat']; 
       echo '<option value="'.$id.'">'.$name.'</option>';
    }
  } 
  ?>
    </select> 
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