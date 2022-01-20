<?php


require_once('../config/boats.php');
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

 
$boat = new Boat();
 $boat->addBoat();

 $displaySup = new Sup(); //create a object
 $data = $displaySup -> displaySup();
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

                            echo "<div class='alert alert-danger alert-dismissible fade show messages' role='alert'>
                            <span>$error</span>  
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
      
                }
                
                ?>


                      <!--------------------------------------- END print message ---------------------------------->



                         <!--------------------------------------- START from ---------------------------------->
                    
<h3 class="text-center mb-5 bien"> Ajouter bateau  </h3>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >nom de representent</label> 
      <select name="id_supp" class="form-control">
       <option selected="true" disabled="disabled" value="" >select representent ...</option>

      <?php if( $data){
      foreach($data as $row){ 
       unset($id, $name);
       $id = $row['id-sup'];
       $name = $row['name-sup']; 
       echo '<option value="'.$id.'">'.$name.'</option>';
    }
  } 
  ?>
    </select> 
   </div>
   <div class="form-group col-md-6">
      <label >Nom bateau</label>
      <input type="text" name="name_boat" class="form-control" placeholder="Entrer le Nom bateau">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Nom capitane</label>
      <input type="text" name="capitane_name" class="form-control" placeholder="Entrer le Nom capitane">
    </div>
    <div class="form-group col-md-6">
      <label >N° capitane</label>
      <input type="text" name="capitane_phone" class="form-control" placeholder="Entrer N° capitane" >
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label >nom du mecanisien</label>
      <input type="text" name="mecanisien_name" class="form-control" placeholder="Entrer le Nom mecanisien">
    </div>
    <div class="form-group col-md-6">
      <label >N° mecanisien</label>
      <input type="text" name="mecanisien_phone" class="form-control" placeholder="Entrer N° mecanisien" >
    </div>
  </div>

    <div class="form-group">
      <label >type</label>
      <!-- <input type="text" name="type" class="form-control" > -->
      <select name="type" class="form-control">
      <option selected="true" disabled="disabled" value="" >select type de Bateau ...</option>
        <option value="type1">type 1</option>
        <option value="type2">type 2</option>
        <option value="type3">type 3</option>
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