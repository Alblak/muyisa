<?php
include_once('../connexion/connexion.php');
if(!isset($_SESSION['fonction']) || empty($_SESSION['fonction'] ))
{
  header('location:../index.php');
}
?>
<header id="header" class="bg-success">
    <div class="d-flex flex-column " >

      <div class="profile">
         <!-- <img src="../assets/img/profils/al.jpg" alt="" class="img-fluid rounded"  height=50> -->
        <img src="../assets/img/logoo.jpg" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="#">MUYISA ÉNERGIE</a></h1>
       
        <div class="social-links mt-3 text-center">
      
         
          <hr class="text-white">

       
        </div>
      </div>
     

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li class=""><a  href="../views/accueil.php" class="nav-link scrollto active pb-0 mb-0 "><i class="bx bx-home text-white"></i><strong> <span>Home</span></strong></a></li>
          
          <?php if($_SESSION['fonction']=="gerant"){?>
                <li ><a href="../views/taux.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-arrow-repeat text-white"></i><strong> <span>Taux d'echange</span></strong></a></li>
                <li ><a href="../views/prix.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-bar-chart-fill text-white"></i><strong> <span>definir le prix</span></strong></a></li>
                <li ><a href="../views/approvisionnement.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-arrow-down-circle-fill text-white"></i><strong> <span>approvisionnement</span></strong></a></li>
          <?php } else if($_SESSION['fonction']=="caissiere"){?>
                 <li ><a href="../views/client.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-people text-white"></i><strong> <span>Client</span></strong></a></li>
                 <li ><a href="../views/sortie.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-arrow-left-circle-fill text-white"></i><strong> <span>sortie</span></strong></a></li>
          <?php } else { ?>
                 <li ><a href="../views/utilisateur.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-people text-white"></i><strong> <span>users</span></strong></a></li>
          <?php } ?>
                 <li ><a  href="../index.html" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-toggle2-off text-white"></i><strong><span>Deconnexion</span></strong> </a></li>
          
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
         

         
         
          
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header>