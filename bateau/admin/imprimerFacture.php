<?php

require_once('../config/facture.php');
require_once('../config/boats.php');
require_once('../config/mission.php');
require_once('../config/tache.php');


  
if(!isset($_SESSION["admin"] )){
     
    if(!isset($_SESSION["user"]) ){
        header("location: ../index.php");
        exit;

    }

}elseif(!isset($_SESSION["admin"])){
    header("location: ../index.php");
    exit;

}

$total_price = 0;
$percentage = 0;
$remise = 0;
$rest_price = 0;
 
 $displayFacture = new Facture(); //create a object
 $dataFact = $displayFacture -> displayFacture();

 $displayBoat = new Boat(); //create a object
 $dataBoat = $displayBoat -> displayAllBoats();

 $displayTache = new Tache(); //create a object
 $dataTache = $displayTache -> displayTacheByMission();
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

<!--------------------------------------- START from ---------------------------------->
                    
<session>
<div class="container mt-5 mb-3">
    <div class="row d-flex justify-content-center">
        <!-- <div class="col-md-8"> -->
        <div>
            
            <!-- Start Test V2 PDF -->
            </br>
            <div  id="container_print_pdf" class="card p-4">
                <div>
                            
                    <div class="d-flex justify-content-center" style="position: relative;">
                        <div style="position: absolute;left: 0px;">
                            <img src="../styles/images/Entraso_logo.jpg" width="48">
                        </div>
                        <div>
                            <h1 class="mt-4"><b>ENTRASOMAR</b><span style="font-size: 1.8rem;" >.SALR</span></h1>
                        </div>
                    </div>
                    </br></br></br></br>
                    <div class="d-flex justify-content-end">
                        <h4>LAAYOUNE LE : <?php echo date("d/m/Y");?></h4>
                    </div>
                    </br></br></br></br>
                    <div class="d-flex justify-content-between">
                    <?php foreach($dataFact as $row){ ?>
                        <h4>FACTURE N°:<?php echo $row['num_facture'];?></h4>
                        <?php if($dataBoat) {

                            foreach($dataBoat as $rowBoat){ 

                            if($rowBoat['id-boat'] == $row['id-boat']){

                            ?> 
                              <h4>Bateau : <?php echo $rowBoat['name-boat'] ?></h4>
                            <?php

                            }
                            ?> 

                            <?php } }?>
                        
                    </div>
                    <!-- S TABLE  -->
                    <!-- <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col"><center>QT</center></th>
                            <th scope="col"><center>DESIGNATION</center></th>
                            <th scope="col"><center>P.U</center></th>
                            <th scope="col"><center>P.T</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><center>1</center></th>
                                
                                <td style="border-bottom-color: white;">
                                    <?php if($dataTache) {

                                    foreach($dataTache as $rowTache){ 
                                    ?> 

                                    <div>- <?php echo $rowTache['tache-name'] ?></div>
                                    <?php } } ?>
                                    </td>
                                <td ><?php echo $rowTache['price'];?> </td>
                                <td ><?php echo $rowTache['price'];?> </td>
                            </tr>
                            
                            <tr>
                                <td style="border-top-color: white;"></td>
                                <th scope="col">TOTAT</td>
                                <th scope="col"><?php echo $row['remise'];?> </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table> -->

                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">QT</th>
                        <th scope="col">DESIGNATION</th>
                        <th scope="col">P.U</th>
                        <th scope="col">P.T</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php if($dataTache) {

                            foreach($dataTache as $rowTache){ 
                            ?> 
                            <tr>
                            <th><?php echo $rowTache['quantite'] ?></th>
                            <td><?php echo $rowTache['tache-name'] ?></td>
                            <td><?php echo $rowTache['price'] ?></td>
                        <td><?php 
                                $priceQte = $rowTache['price'] * $rowTache['quantite'];
                                $total_price += $priceQte;
                                echo $priceQte;
                            ?>
                        </td>
                            </tr>
                            <?php } } ?>

                            <tr>
                        <th scope="col" colspan="2"></th>
                        <th scope="col">TOTALE</th>
                        <th scope="col"><?php echo $total_price ?> </th>
                        </tr>
                    </tbody>
                    </table>

                    <!-- E TABLE -->
                    <div>
                        <h5 style="-webkit-text-decoration-line: underline;text-decoration-line: underline;">Arrêtée la présente facture à la somme de :</h5>
                        <h5 style="-webkit-text-decoration-line: underline;text-decoration-line: underline;">HUITE CENT DIRHAMS.</h5>
                    </div>
                    </br></br></br></br>
                    <div>
                        <h5 style="margin-left:30em;">Signature :</h5>  
                    </div>
                    </br></br>
                    </br></br>
                    </br></br>
                    <!-- </br></br> -->
                    <hr/>
                    <div class="Infos" style="position: absolute;bottom: 0;">
                        <p style="margin-bottom: 0rem;font-size: 11px;" >140 Avenue Mohammed V AL Marsa Laayoune GSM: 06 62 27 43 44/06 68 72 57 72 -Fax: 05 28 99 85 48 BP:450 E-mail: entrasomar@gmail.com</p  >
                        <p style="margin-bottom: 0rem;font-size: 11px;"  >Capital: 100 000 00. R.C: 4933 Laayoune. CNSS: 4269355 - IF, 20703333- ICE: 001941883000084 - B.P: 143 430 21211 5992724 0014 95</p  >
                    </div>
                </div>
            </div>
            <!-- End Test V2 PDF -->


            <!-- Button Imprimer -->
            </br>
            <div>
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-success w-100 btn-lg" type="button" onclick="printPdf()" ><i class="fas fa-print"></i> Imprimer </button>
                </div>
            </div>
            <!--  -->
        </div>
    </div>
</div>
</session>

            </main>

        </div>
    </div>
    <?php
    require_once('../includes/script.php');
   ?>
</body>

</html>