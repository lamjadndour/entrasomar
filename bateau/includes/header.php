<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../styles/css/dash.css">
    <link rel="stylesheet" href="../styles/css/style.css">

    <!-- PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
 
    <title>dahsborad</title>
</head>

<body>
    <div class="dash">
        <div class="dash-nav dash-nav-dark">
            <header>
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars"></i>                
                </a>
                <a href="dashboard.php" class="easion-logo"><i class="fas fa-ship"  style="color:rgb(255, 222, 173) "></i> <span>Entrasomar</span></a>
            </header>
            <nav class="dash-nav-list">
        

              <a href="dashboard.php" class="dash-nav-item">
                    <i class="fas fa-home"></i> Dashboard </a>
                    <?php  if(isset($_SESSION["admin"]) ){     // 
               echo ' <div class="dash-nav-dropdown">
                    <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
                        <i class="fas fa-users"></i> Admin </a>
                
                  <div class="dash-nav-dropdown-menu">
                        <a href="addusers.php" class="dash-nav-dropdown-item">ajouter utilisateur</a>
                    </div>
                    <div class="dash-nav-dropdown-menu">
                        <a href="showusers.php" class="dash-nav-dropdown-item">afficher utilisateur</a>
                    </div>
                </div>

              ';
            
                        }
                ?>
                 <div class="dash-nav-dropdown ">
                    <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
                    <i class="fas fa-ship"></i> Bateaux </a>
                    <div class="dash-nav-dropdown-menu">
                        <a href="addBoat.php" class="dash-nav-dropdown-item">Ajouté bateau</a>
                        <a href="showBoat.php" class="dash-nav-dropdown-item">Afficher bateaux</a>

                    </div>
                    </div>

                    <!-- Start Superviseur  -->
                    <div class="dash-nav-dropdown ">
                    <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
                    <i class="fas fa-users"></i> Superviseur </a>
                        <div class="dash-nav-dropdown-menu">
                          <a href="addSup.php" class="dash-nav-dropdown-item">Ajouté Superviseur</a>
                          <a href="showSup.php" class="dash-nav-dropdown-item">Afficher Superviseur</a>
                        <!-- <a href="searchSup.php" class="dash-nav-dropdown-item">Chercher Superviseur</a> -->

                    </div>
                    <!-- End Superviseur  -->

                     <!-- Start Plangeur  -->
                        <div class="dash-nav-dropdown ">
                        <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
                        <i class="fas fa-hammer"></i> Planguer </a>
                            <div class="dash-nav-dropdown-menu">
                                <a href="addPlangeur.php" class="dash-nav-dropdown-item">Ajouté Palngeur</a>
                                <a href="showPlangeur.php" class="dash-nav-dropdown-item">Afficher Plangeur</a>
                                <!-- <a href="searchSup.php" class="dash-nav-dropdown-item">Chercher Superviseur</a> -->

                            </div>
                        </div>
                     <!-- End Plangeur -->

                    <div class="dash-nav-dropdown ">
                    <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
                    <i class="fas fa-clipboard-list"></i> Mission </a>
                    <div class="dash-nav-dropdown-menu">
                        <a href="addMission.php" class="dash-nav-dropdown-item">Ajouté Mission</a>
                        <a href="showMission.php" class="dash-nav-dropdown-item">Afficher Mission</a>
                        <!-- <a href="searchBoat.php" class="dash-nav-dropdown-item">Chercher bateaux</a> -->

                    </div>
                    </div>

                    <div class="dash-nav-dropdown ">
                <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
                <i class="fas fa-dolly-flatbed"></i> Service </a>
                    <div class="dash-nav-dropdown-menu">
                        <a href="addService.php" class="dash-nav-dropdown-item">Ajouté Categorie</a>
                        <a href="showService.php" class="dash-nav-dropdown-item">Afficher Categorie</a>
                    </div>
                </div>
               

                <div class="dash-nav-dropdown ">
                    <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
                    <i class="fas fa-clipboard-list"></i> Facture </a>
                    <div class="dash-nav-dropdown-menu">
                        <a href="showAllFacture.php" class="dash-nav-dropdown-item">Afficher All Facture</a>
                      

                    </div>
                    </div>
           
            </nav>
        </div>
        <div class="dash-app">
            <header class="dash-toolbar">
                <a href="#!" class="menu-toggle"> 
                    <i class="fas fa-bars"></i>
                </a>
                <a href="#!" class="searchbox-toggle"> 
                    <i class="fas fa-search"></i>
                </a>
                <div style="color:black;font-size:30px;font-weight:bold">Gestion des Bateaux</div>
                <!-- <form class="searchbox" action="#!">
                    <a href="#!" class="searchbox-toggle"> <i class="fas fa-arrow-left"></i> </a>
                    <button type="submit" class="searchbox-submit"> <i class="fas fa-search"></i> </button>
                    <input type="text" class="searchbox-input" placeholder="type to search">
                </form> -->
                <div class="tools">
                    <div class="dropdown tools-item">
                        <a href="#" class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </header>










            