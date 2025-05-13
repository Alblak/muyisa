<?php 
include('../../connexion/connexion.php');
if (isset($_POST["valider"])) 
{
    $date=date("Y-m-d");
    $libelle=htmlspecialchars($_POST['libelle']);
    $montant=htmlspecialchars($_POST['montant']);
    $req=$connexion->prepare("INSERT INTO bondesortie (dates,libelle,montant) values (?,?,?)");
    $req->execute(array($date,$libelle,$montant)); 
     if($req)
     {
        $_SESSION['notif']="Enregistrement reussi";
        $_SESSION['color']='success';
        $_SESSION['icon']="check-circle-fill";
        header('location:../../views/bondesortie.php');
    }
 }


?>