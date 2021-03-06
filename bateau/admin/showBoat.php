<?php

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



// $histoCommande = new Commandes(); //create a object
// $data =$histoCommande ->displayCommande(); //call function from class commandes to return resulat 

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
print_r($allRecrods);

// Calculate total pages
$totoalPages = ceil($allRecrods / $limit);

// Prev + Next
$prev = $page - 1;
$next = $page + 1;


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

                <?php
                if(isset($_GET["error"])){
                    $error =$_GET["error"];
                        if($error == "success"){
                            echo "<div class='alert alert-success alert-dismissible fade show messages' role='alert'>
                            <span>The operation completed successfully </span>  
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
                
                                 
                <h3 class="text-center mb-5 bien">Afficher les bateaux</h3>

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
                
                <th scope="col">nom representent</th>
                <th scope="col">nom Bateau</th>
                <th scope="col">nom Capitane</th>
                <th scope="col">t??l??phone capitane</th>
                <th scope="col">Mecanisien</th>
                <th scope="col">t??l??phone mecanisien</th>
                <th scope="col">type de Bateau</th>
                <th scope="col">La Date</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($authors as $row): ?>
                <tr>
              
               
               
                <?php if($dataSup) {
                    foreach($dataSup as $rowSup){ 
                        if($rowSup['id-sup'] == $row['id-sup']){
                        ?> 
                             <td><?php echo $rowSup['name-sup'];?></td>
                        <?php
                        }
                    ?> 

                    <?php } }?>
                <td><?php echo $row['name-boat']  ?></td>
                <td><?php echo $row['name-capitane-boat']  ?></td>
                <td><?php echo $row['capitane-phone-boat']  ?></td>
                <td><?php echo $row['mecanisien-name']  ?></td>
                <td><?php echo $row['phone-mecanisien']  ?></td>
                <td><?php echo $row['type-boat']  ?></td>
                <td><?php echo $row['date']  ?></td>
                <td> <button class="btn btn-success mx-auto"><a href="editBoat.php?id-boat=<?php echo $row['id-boat'] ?>">Modifier</a></button>
                <button type='button' class="btn btn-danger mx-auto" ><a onclick="suppr(event)" data-toggle="modal" data-target="#exampleModal" class='<?php echo $row['id-boat'] ?>' >supprimer</a></button>

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
                    <a class="page-link" href="histCom.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                </li>
                <?php endfor; ?>

                <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?page=". $next; } ?>">Next</a>
                </li>
            </ul>
        </nav>

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
          <button type="button" class="btn btn-primary"><a  class='supprime'>j'accepte</a></button>
      </div>
    </div>
  </div>
</div>







     <!--------------------------------------- END  show all users and admins ---------------------------------->


                </div>
            </main>

           <!--------------------------------------- START Container---------------------------------->

        </div>
    </div>
  
    <?php require_once('../includes/script.php'); ?>


</body>

</html>