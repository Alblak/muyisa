<?php 
include('../../connexion/connexion.php');
if (isset($_POST["valider"])) 
{
    $dates=date('Y-m-d');
    $quantite=htmlspecialchars($_POST['quantite']);
    $montant=htmlspecialchars($_POST['montant']);
   

  
    $req=$connexion->prepare("INSERT INTO approvisionnement (dates,quantite,montant) values (?,?,?)");
    $req->execute(array($dates,$quantite,$montant)); 
     if($req)
     {
        $_SESSION['notif']="Enregistrement reussi";
        $_SESSION['color']='success';
        $_SESSION['icon']="check-circle-fill";
        header('location:../../views/approvisionnement.php');
    }
 }


?>