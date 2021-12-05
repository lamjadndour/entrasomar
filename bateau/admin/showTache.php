
<?php

require_once('../config/tache.php');
require_once('../config/service.php');
require_once('../config/plangeur.php');
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


if(isset($_POST['records-limit'])){
  $_SESSION['records-limit'] = $_POST['records-limit'];
}
$id_mission = $_GET['id-mission'];
$limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 10;
$page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
$paginationStart = ($page - 1) * $limit;

 $sql= $db->connection->prepare("SELECT * FROM tache WHERE `id-mission` = $id_mission LIMIT $paginationStart, $limit");
 $sql->execute();
 $tache=$sql->fetchAll();
// Get total records
$stm = $db->connection->prepare("SELECT count(`id-tache`) AS id FROM tache");
$stm->execute();
$res=$stm->fetchAll();
$allRecrods = $res[0]['id'];
// print_r($allRecrods);

// Calculate total pages
$totoalPages = ceil($allRecrods / $limit);

// Prev + Next
$prev = $page - 1;
$next = $page + 1;


   $displayService = new Service(); //create a object
   $resService =$displayService ->displayAllService();

   $displayPlangeur = new Plangeur(); //create a object
   $resPlangeur =$displayPlangeur ->displayAll();

   
   $facture = new facture();
   $dataFacture = $facture->displayFacture();


   $total_price = 0
?>




<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
            <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">
                <!----------------------Partie Error ------------------------------>
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
                // $_GET['id-mission'] ? $_SESSION['idMission'] = $_GET['id-mission'] : $_SESSION['idMission'] = $_GET['id-mission'];


                ?>
    <?php if(!$dataFacture) {
        ?>
        <button class="btn btn-info mx-auto tachbtn"><a href="addTache.php?id-mission=<?php echo $_GET['id-mission'] ?>">Add New Tache </a></button> 
        <?php } 
        ?>
        <h3 class="text-center mb-5 bien">Afficher les taches</h3>
        <div class="d-flex flex-row-reverse bd-highlight mb-3">
            <form action="showBoat.php" method="post">
                <select name="records-limit" id="records-limit" class="custom-select">
                    <option disabled selected>Records Limit</option>
                    <?php foreach([10,20,30,40,50,60,70,80,90,100,1000] as $limit) : ?>
                    <option
                        <?php if(isset($_SESSION['records-limit']) && $_SESSION['records-limit'] == $limit) echo 'selected'; ?>
                        value="<?= $limit; ?>">
                        <?= $limit; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <!-- Datatable -->
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter serie de bateau ">
        <table class="table table-bordered mb-5" id="myTable">
            <thead>
                <tr class="table-success">
                <tr class="table-success">
                <th scope="col">id mission</th>
                <th scope="col">id service</th>
                <th scope="col">price tache</th>
                <th scope="col">id plangeur</th>
                <th scope="col">Status</th>
                <th scope="col">date start</th>
                <th scope="col">date end</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tache as $row): ?>
                <tr>
              
                <td><?php echo $row['id-mission']  ?></td>
                <?php if($resService) {

                foreach($resService as $rowS){ 

                if($rowS['id-service'] == $row['id-service']){

                    $total_price += $rowS['price-service']
                
                ?> 
                    <td><?php echo $rowS['name-service']  ?></td>
                    <td><?php echo $rowS['price-service'] ;?> DH </td>

                    
                <?php
                

                }
                ?> 

                <?php } }?>
               
        
                <?php if($resPlangeur) {

                foreach($resPlangeur as $rowP){ 

                if($rowP['id-plangeur'] == $row['id-plangeur']){
                
                ?> 
                    <td><?php echo $rowP['name-plangeur']  ?></td>
                <?php

                }
                ?> 

                <?php } }?>

                <td><?php echo $row['status-tache']  ?></td>
                <td><?php echo $row['date-start']  ?></td>
                <td><?php echo $row['date-end']  ?></td>
                <td> <button class="btn btn-success mx-auto"><a href="editTache.php?id-tache=<?php echo $row['id-tache'] ?>">Modifier</a></button>
                <button type='button' class="btn btn-danger mx-auto" ><a onclick="supprTache(event)" class='<?php echo $row['id-tache'] ." ". $row['id-mission'] ?>' data-toggle="modal" data-target="#exampleModal">supprimer</a></button>
                </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

          

        <!-- Pagination -->
        <nav aria-label="Page navigation example mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev; } ?>">Previous</a>
                </li>

                <?php for($i = 1; $i <= $totoalPages; $i++ ): ?>
                <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                    <a class="page-link" href="showTache.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                </li>
                <?php endfor; ?>

                <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?page=". $next; } ?>">Next</a>
                </li>
            </ul>
        </nav>



     <!--------------------------------------- END  show all  ---------------------------------->

        <!--------------------- total AND Facture ------------------------->
        <div class="row">

        <div class="col-md-2 productbox ">
            <div class="producttitle">Total Price</div>
            <div class="productprice"><div class="pull-right"></div>
            <div class="pricetext"><?php echo $total_price ?> DH</div></div>

        </div>

        <?php if($dataFacture) {
            // $rub = $row['id-sup'];
        ?> 
        <div class="col-md-2 productbox ">
            <div class="producttitle">Afficher Facture</div>
            <div class="productprice"><div class="pull-right"></div>
            <button class="btn btn-info mx-auto tachbtn">
                <a href="showFacture.php?id-mission=<?php echo $_GET['id-mission']?>"> 
                Afficher Facture
                </a>
            </button>
        </div>

          <?php }else{ ?>

        <div class="col-md-2 productbox ">
            <div class="producttitle">Créér facture</div>
            <div class="productprice"><div class="pull-right"></div>
            <button class="btn btn-info mx-auto tachbtn">
                <a href="addFacture.php?id-mission=<?php echo $_GET['id-mission']?>&id-boat=<?php echo $_GET['id-boat']?>&total=<?php echo $total_price?>"> 
                Créer Facture
                </a>
            </button>
        </div>


        <?php } ?>

        </div>


                </div>
            </main>
            
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Click j'accepte pour supprimer</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary"><a href="delete.php?id-tache=<?php echo $row['id-tache'] ?>&id-mission=<?php echo $_GET['id-mission'] ?>">j'accepte</a></button>
      </div>
    </div>
  </div>
</div>


           <!--------------------------------------- START Container---------------------------------->

        </div>
    </div>
    <?php require_once('../includes/script.php'); ?>


</body>

</html>