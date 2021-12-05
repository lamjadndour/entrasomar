<?php


require_once('../config/tache.php');
require_once('../config/Plangeur.php');
require_once('../config/service.php');

  
if(!isset($_SESSION["admin"] )){
     
    if(!isset($_SESSION["user"]) ){
        header("location: ../index.php");
        exit;

    }

}elseif(!isset($_SESSION["admin"])){
    header("location: ../index.php");
    exit;

}

 
$tache = new Tache();
$result = $tache->addTache();
 

 $displayPlangeur = new Plangeur(); //create a object
 $data = $displayPlangeur -> displayAll();

 $displayService = new Service(); //create a object
 $dataService = $displayService -> displayAllService();

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

    // if($result){
    //     echo "<div class='alert alert-danger alert-dismissible fade show messages' role='alert'>
    //                     <span>$result</span>  
    //                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    //             <span aria-hidden='true'>&times;</span>
    //             </button>
    //             </div>";
    // }
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
// $_GET['id-mission'] ? $_SESSION['idMission'] = $_GET['id-mission'] : $_SESSION['idMission'] = $_GET['id-mission'];


?>


<!--------------------------------------- END print message ---------------------------------->

<!--------------------------------------- START from ---------------------------------->
                    
<h3 class="text-center mb-5 bien"> Ajouter Tache  </h3>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >  
<div class="form-row">
    
      <label >tache name</label>
      <input type="text" name="tache_name" class="form-control" placeholder="Entrer le nom de tache">
 
  </div>

  <div class="form-row">
  <input type="hidden" value="<?php echo $_GET['id-mission']; ?>" name="id_mission" class="form-control" >

  <div class="form-group col-md-6">
      <label >id service</label>
      <select name="id_service" class="form-control">
       <option selected="true" disabled="disabled" value="" >select service ...</option>

       
    <?php if( $dataService){
        foreach($dataService as $row){ 
        unset($id, $name);
        $id = $row['id-service'];
        $name = $row['name-service']; 
        echo '<option value="'.$id.'">'.$name.'</option>';
        }
       } 
    ?>
    </select> 
   </div>
   
  <div class="form-group col-md-6">
      <label >id plangeur</label>
      <select name="id_plangeur" class="form-control">
       <option selected="true" disabled="disabled" value="" >select plangeur ...</option>

       <?php if( $data){
        foreach($data as $row){ 
        unset($id, $name);
        $id = $row['id-plangeur'];
        $name = $row['name-plangeur']; 
        echo '<option value="'.$id.'">'.$name.'</option>';
        }
       } 
    ?>
        
    
    </select> 
    </div>  
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Date Start</label>
      <input type="date" name="date_start" class="form-control" >
    </div>
    <div class="form-group col-md-6">
      <label >Date End</label>
      <input type="date" name="date_end" class="form-control" >
    </div>
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