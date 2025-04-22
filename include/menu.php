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
        <img src="../assets/img/logo.png" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="#">MUYISA ÉNERGIE</a></h1>
       
        <div class="social-links mt-3 text-center">
      
         
          <hr class="text-white">

       
        </div>
      </div>
     

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li class=""><a  href="../views/accueil.php" class="nav-link scrollto active pb-0 mb-0 "><i class="bx bx-home text-white"></i><strong> <span>Home</span></strong></a></li>
          
         
          <li ><a href="../views/taux.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-arrow-left-right text-white"></i><strong> <span>Taux d'echange</span></strong></a></li>
          <li ><a href="../views/utilisateur.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-people text-white"></i><strong> <span>users</span></strong></a></li>
          <li ><a  href="../index.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-toggle2-off text-white"></i><strong><span>Deconnexion</span></strong> </a></li>
          
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