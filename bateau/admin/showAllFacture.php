<?php

require_once('../config/facture.php');
require_once('../config/boats.php');
require_once('../config/sups.php');



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

$limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 10;
$page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
$paginationStart = ($page - 1) * $limit;

 $sql= $db->connection->prepare("SELECT * FROM boat LIMIT $paginationStart, $limit");
 $sql->execute();
 $authors=$sql->fetchAll();
// Get total records
$stm = $db->connection->prepare("SELECT count(`id-boat`) AS id FROM boat");
$stm->execute();
$res=$stm->fetchAll();
$allRecrods = $res[0]['id'];
// print_r($allRecrods);

// Calculate total pages
$totoalPages = ceil($allRecrods / $limit);

// Prev + Next
$prev = $page - 1;
$next = $page + 1;



$facture = new facture();
$data = $facture->displayAllFacture();

$boat = new Boat();
$dataBoat = $boat->displayAllBoats();

$sup = new Suprv();
$dataSup = $sup->displayAllSups();
?>




<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
            <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">
                <h3 class="text-center mb-5 bien w-100"}> Afficher tous les Factures  </h3>

                <div class="d-flex flex-row-reverse bd-highlight mb-3">
            <form action="showAllFacture.php" method="post">
                <select name="records-limit" id="records-limit" class="custom-select">
                    <option disabled selected>Records Limit</option>
                    <?php foreach([20,40,60,80,100,1000,5000] as $limit) : ?>
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
        
       <?php 
       if($data){
       ?>

<div class="form-row">
    <div class="form-group col-md-4">
      <label class="font-weight-bold">Recherche par nom de Bateau</label>
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter serie de boat ">
    </div>
    <div class="form-group col-md-4">
      <label class="font-weight-bold">Recherche par le nom de Représentent</label>
     <input type="text" id="inputSup" onkeyup="SearchBySup()" placeholder="Enter le Nom de sup ">
    </div>
    <div class="form-group col-md-4">
      <label class="font-weight-bold">Recherche par Status</label>
     <input id="payment" class="form-control" onkeyup="SearchByPayment()">
     
    </div>
  </div>




        <table class="table table-bordered mb-5" id="myTable">
            <thead>
                <tr class="table-success">
                <tr class="table-success">
    
                <th scope="col">nom de Bateau</th>
                <th scope="col">nom sup</th>
                <th scope="col">avance</th>
                <th scope="col">total</th>
                <th scope="col">prix final</th>
                <th scope="col">rest a payer</th>
                <th scope="col">status</th>
                <th scope="col">action</th>

                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $row): ?>
            <tr>
            <?php if($dataBoat) {

                foreach($dataBoat as $rowBoat){ 

                    if($rowBoat['id-boat'] == $row['id-boat']){
                    ?> 
                        <td><?php echo $rowBoat['name-boat']  ?></td>
                    <?php
                    }
                ?> 

                <?php } ?>


           <?php }?>

           <?php foreach($dataSup as $rowSup){ 

                if($rowSup['id-sup'] == $row['id-sup']){
                
                ?> 
                    <td><?php echo $rowSup['name-sup']  ?></td>
                <?php }  }?>

                <td><?php echo $row['avance'] ?>DH</td>
                <td><?php echo $row['total'] ?> DH</td>
                <td><?php echo $row['remise']?> DH </td>
                <td><?php echo $row['reste'] ?> DH</td>
                <?php if($row['reste'] == 0){?>
                 <td class=td_payer>payer</td>
                 <?php } else { ?>
                 <td class=td_non_payer>non payer</td>
                 <?php } ?>
                <td><button class="btn btn-info  mx-auto"><a href="imprimerFacture.php?id-mission=<?php echo $row['id-mission'] ?>">Afficher</a></button>
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
                    <a class="page-link" href="showAllFacture.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                </li>
                <?php endfor; ?>

                <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?page=". $next; } ?>">Next</a>
                </li>
            </ul>
        </nav>

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