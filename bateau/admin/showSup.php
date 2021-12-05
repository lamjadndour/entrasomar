<?php

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

 $sql= $db->connection->prepare("SELECT * FROM sup LIMIT $paginationStart, $limit");
 $sql->execute();
//  $authors=$sql->fetchAll();
$suprvs=$sql->fetchAll();
// Get total records
$stm = $db->connection->prepare("SELECT count(`id-sup`) AS id FROM sup");
$stm->execute();
$res=$stm->fetchAll();
$allRecrods = $res[0]['id'];
print_r($allRecrods);

// Calculate total pages
$totoalPages = ceil($allRecrods / $limit);

// Prev + Next
$prev = $page - 1;
$next = $page + 1;

?>








<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
                                     <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">

                <h3 class="text-center mb-5 bien">Show Superviseures</h3>
                                 
             

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
                <th scope="col">Nom Superviseur</th>
                <th scope="col">Phone Superviseur</th>
                <th scope="col">La Date</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($suprvs as $row): ?>
                <tr>
                <td><?php echo $row['name-sup']  ?></td>
                <td><?php echo $row['phone-sup']  ?></td>
                <td><?php echo $row['date']  ?></td>


                <td> 
                    <!-- <button class="btn btn-success mx-auto"> -->
                   
                    <button class="btn btn-success mx-auto"><a href="editSup.php?id-sup=<?php echo $row['id-sup'] ?>">Modifier</a></button>
                    <!-- </button> -->


                    <!-- <button class="btn btn-danger  mx-auto"> -->
                    <button type='button' class="btn btn-danger mx-auto" ><a onclick="supprSup(event)" class='<?php echo $row['id-sup'] ?>' data-toggle="modal" data-target="#exampleModal">supprimer</a></button>
                    <!-- </button> -->
                    
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
                    <a class="page-link" href="showSup.php?page=<?= $i; ?>"> <?= $i; ?> </a>
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
          <button type="button" class="btn btn-primary"><a class="supp">j'accepte</a></button>
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