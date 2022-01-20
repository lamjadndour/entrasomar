
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
$id_plangeur = $_GET['id-plangeur'];
$limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 10;
$page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
$paginationStart = ($page - 1) * $limit;

 $sql= $db->connection->prepare("SELECT * FROM tache  WHERE `id-plangeur` = $id_plangeur LIMIT $paginationStart, $limit");
 $sql->execute();
 $tache=$sql->fetchAll();
// Get total records
$stm = $db->connection->prepare("SELECT count(`id-plangeur`) AS id FROM tache");
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

   
//    $facture = new facture();
//    $dataFacture = $facture->displayFacture();

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
  
        <h3 class="text-center mb-5 bien">Afficher les taches</h3>
        <div class="d-flex flex-row-reverse bd-highlight mb-3">
            <form action="showTachPlang.php?id-plangeur=<?php echo $_GET['id-plangeur']?>" method="post">
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
        <input type="text" id="myInput" onkeyup="myFunctionTach()" placeholder="Recherche par Prime ">
        <table class="table table-bordered mb-5" id="myTable">
            <thead>
                <tr class="table-success">
                <tr class="table-success">
                <th scope="col">tache name</th>
                <th scope="col">categorie</th>
                <th scope="col">plangeur</th>
                <th scope="col">price tache</th>
                <th scope="col">Status</th>
                <th scope="col">Prime</th>
                <th scope="col">date</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tache as $row): ?>
                <tr>
                <td><?php echo $row['tache-name']  ?></td>
                
                <?php if($resService) {

                foreach($resService as $rowS){ 

                if($rowS['id-service'] == $row['category']){

                    // $total_price += $rowS['price-service']
                
                ?> 
                    <td><?php echo $rowS['name-service']  ?></td>
                    
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

                <td><?php echo $row['price'] ?></td>

                <!-- Calcule prix total de mission -->
                <?php 
                $total_price += $row['price']
                ?>

                <td><?php echo $row['status-tache'] ?></td>
                <td><?php echo $row['prime'] ?></td>
                <td><?php echo $row['date'] ?></td>
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
                    <a class="page-link" href="showTachPlang.php?id-plangeur=<?php echo $_GET['id-plangeur'] ?>&page=<?= $i; ?>"> <?= $i; ?> </a>
                </li>
                <?php endfor; ?>

                <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?page=". $next; } ?>">Next</a>
                </li>
            </ul>
        </nav>



     <!--------------------------------------- END  show all  ---------------------------------->

                </div>
            </main>
            
       


           <!--------------------------------------- START Container---------------------------------->

        </div>
    </div>
    <?php require_once('../includes/script.php'); ?>


</body>

</html>