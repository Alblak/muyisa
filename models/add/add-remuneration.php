<?php 
include('../../connexion/connexion.php');
if (isset($_POST["valider"])) 
{
    $dates=date("Y-m-d");
    $personnel=$_GET['idpersonnel'];
    $montant=htmlspecialchars($_POST['montant']);
    $mois=$_GET['idmois'];
    $annee=date('Y');
    $req=$connexion->prepare("INSERT INTO remuneration (dates,personnel,montant,mois,annee) values (?,?,?,?,?)");
    $req->execute(array($dates,$personnel,$montant,$mois,$annee)); 
     if($req)
     {
        $_SESSION['notif']="Enregistrement reussi";
        $_SESSION['color']='success';
        $_SESSION['icon']="check-circle-fill";
        header('location:../../views/remuneration.php');
    }
 }


?>