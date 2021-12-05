<?php

require_once('../config/admin.php');




if(!isset($_SESSION["admin"]) ){  //check if session admin found or not 
  header("location: ../index.php");
  exit();
}


$displayAdmins = new Admin(); //create a object
$data =$displayAdmins ->displayadmins(); //call function from class admin to return resulat 








?>








<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
                                     <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">
                   



                         <!--------------------------------------- START show all users and admins ---------------------------------->
<h3 class="text-center mb-5 bien">Show all Admins and Users</h3>



<table class="table text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">password</th>
      <th scope="col">roles</th>
      <th scope="col">edit</th>
    </tr>
  </thead>
  <tbody>
<?php if( $data){
 foreach($data as $row){ ?>
      
     
    <tr>
      <th scope="row"><?php echo $row['id_admin']  ?></th>
      <td><?php echo $row['username']  ?></td>
      <td><?php echo $row['passwords']  ?></td>
      <td><?php echo $row['role']  ?></td>
      <td> 
      <button class="btn btn-success  mx-auto"><a href="editusers.php?id_admin=<?php echo $row['id_admin'] ?>">Edit</a></button>
      <button class="btn btn-danger mx-auto"><a href="delete.php?id_admin=<?php echo $row['id_admin'] ?>">Delete</a></button>


    
      </td>
      

    </tr>
    
    <?php
    }
  } 
  ?>



  </tbody>
</table>
       




     <!--------------------------------------- END  show all users and admins ---------------------------------->


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