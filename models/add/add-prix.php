<?php 
include('../../connexion/connexion.php');
if (isset($_POST["valider"])) 
{
    $date=date("Y-m-d");
    $prix_essenceL=htmlspecialchars($_POST['prix_essenceL']);
    $prix_mazoutL=htmlspecialchars($_POST['prix_mazoutL']);
    $prix_essenceF=htmlspecialchars($_POST['prix_essenceF']);
    $prix_mazoutF=htmlspecialchars($_POST['prix_mazoutF']);
    $req=$connexion->prepare("INSERT INTO prix (dates,prix_essenceL,prix_mazoutL,prix_essenceF,prix_mazoutF) values (?,?,?,?,?)");
    $req->execute(array($date,$prix_essenceL,$prix_mazoutL,$prix_essenceF,$prix_mazoutF)); 
     if($req)
     {
        $_SESSION['notif']="Enregistrement reussi";
        $_SESSION['color']='success';
        $_SESSION['icon']="check-circle-fill";
        header('location:../../views/prix.php');
    }
 }


?>