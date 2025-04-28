<?php 
include('connexion/connexion.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="styles.css">
    <link href="assets/img/logo.png" rel="icon">
    <!-- Lien vers les icônes (ex: FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- <link rel="stylesheet" href="icones_login.css"> -->
</head>
</head>
<body>
    <div class="login-container">
        <div class="left-side">
            <div class="background-dark  bg-success">
                <div class="devise">
                    <center><div class="round-photo-container">
                        <img src="assets/img/logoo.jpg" alt="Photo ronde" class="round-photo">
                    </div></center>
                    <p>"carburant de qualite"</p>
                </div>
            </div>
        </div>
        <div class="right-side">
        <form class="row g-3 needs-validation" method="POST" action="models/login_traitement.php?fonction=<?=$_GET['fonction']?>">
                <h2>Connexion</h2>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Nom d'utilisateur"name="username" id="username" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Mot de passe"name="password" id="password" required>
                </div>
                <button name="valider" id="valider" class="btn btn-info" type="submit">Se connecter</button>
             
              
                <?php if(isset($_SESSION['notif']) && !empty($_SESSION['notif'])){ ?>
                    <Center><p class="text-warning"><i class="bi bi-<?=$_SESSION['icon']?>"></i><?php echo $_SESSION['notif'];unset($_SESSION['notif']);?> </p></Center>
                    <?php } ?>
                   
              
            </form>
        </div>
     
    </div>
</body>
</html>