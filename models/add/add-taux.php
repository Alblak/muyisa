<?php 
include('../../connexion/connexion.php');
if (isset($_POST["valider"])) 
{
    $date=date("Y-m-d");
    $equivalent=htmlspecialchars($_POST['equivalent']);
   
    $req=$connexion->prepare("INSERT INTO taux (dates,equivalent) values (?,?)");
    $req->execute(array($date,$equivalent)); 
     if($req)
     {
        $_SESSION['notif']="Enregistrement reussi";
        $_SESSION['color']='success';
        $_SESSION['icon']="check-circle-fill";
        header('location:../../views/taux.php');
    }
 }


?>