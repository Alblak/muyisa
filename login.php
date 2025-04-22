<?php include_once('connexion/connexion.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login </title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link href="assets/img/logo.png" rel="icon">
  <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">

  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/css/style.css">
  <link rel="stylesheet" href="assets/css/css/components.css">
<!-- Start GA -->

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body class="bg-dark">
  <div id="app">
    <section class="section ">
      <div class="container mt-5">
        <div class="row ">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="assets/img/logo.png" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-warning shadow-dark">
              <div class="card-header  "><h4 class="text-center">Authentification</h4></div>

              <div class="card-body">
                <form method="POST" action="models/login_traitement.php?fonction=<?=$_GET['fonction']?>" class="needs-validation" novalidate="">
                  
                    <div class="form-group ">
                          <label class="text-label">Matricule ou username</label>
                          <div class="input-group">
                               <div class="input-group-prepend ">
                                    <span class="input-group-text bg-dark"> <i class="bi bi-person-circle text-white"></i> </span>
                                </div>
                                <input type="text" required  class="form-control" id="username" name="username" placeholder="Entrer le username..">
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="text-label">Password</label>
                          <div class="input-group">
                               <div class="input-group-prepend">
                               <span class="input-group-text bg-dark"> <i class="bi bi-lock-fill text-white"></i> </span>
                                </div>
                                <input type="password"  id="password" type="password" required  class="form-control" name="password" placeholder="Entrer le mot de passe">
                          </div>
                    </div>
               
                    <?php if(isset($_SESSION['notif']) && !empty($_SESSION['notif'])){ ?>
                    <Center><p class="text-warning"><i class="bi bi-<?=$_SESSION['icon']?>"></i><?=$_SESSION['notif']?></p></Center>
                    <?php } ?>
                  <div class="form-group">
                    <button type="submit"  name="valider" class="btn btn-dark btn-lg btn-block">
                     Se connecter 
                    </button>
                  </div>
                </form>
              

              </div>
            </div>
       
            <div class="simple-footer text-white">
              Copyright &copy; MUYISA ÉNERGIE 2025
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>