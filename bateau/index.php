<?php
require_once('./config/login.php');
  
if(isset($_SESSION["admin"]) || isset($_SESSION["admin"])){
     

    header("location: admin/dashboard.php");
  

}else{
    $login = new Login();
    $msg =$login->check();
}
 





 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/style.css">
    <link rel="stylesheet" href="styles/css/dash.css">
    <title>login</title>
</head>
<body class='cont'>
<?php
       if($msg){
          
              
            echo "<div class='alert alert-danger alert-dismissible fade show messages' role='alert'>
            <span>$msg</span>  
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span>
  </button>
</div>";
       
          }
        
       ?>
    
     
     <?php echo $msg ?>
     <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="./styles/images/trawler-boat.png" class="image"> </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                    
                <div class="row mx-auto"> <img src="./styles/images/Entraso_logo.jpg" class="logo"> </div>
                <form class="login" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" >
                    <div class="row px-3"> <label class="mb-1 d-block mx-auto">
                            <h6 class="mb-0 text-sm  ">Username</h6>
                        </label> <input class="mb-4 rounded-pill" type="text" name="username" placeholder="Enter a Username"> </div>
                    <div class="row px-3 "> <label class="mb-1 d-block mx-auto">
                            <h6 class="mb-0 text-sm  ">Password</h6>
                        </label> <input class="rounded-pill" type="password" name="password" placeholder="Enter password"> </div>
                    <div class="row px-3 mb-4">
                    </div>
                    <div class="row mb-3 px-3"> <button name="submit" type="submit" class="btn btn-blue d-block mx-auto text-center rounded-pill">Login</button> </div>
                </div>
                </form>
            </div>
        </div>
        
    </div>
</div>
     

   </body>
   </html>



   