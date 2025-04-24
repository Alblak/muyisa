<?php 
include('../../connexion/connexion.php');
if (isset($_POST["valider"])) 
{
    $date=date("Y-m-d");
    $prix_essence=htmlspecialchars($_POST['prix_essence']);
    $prix_mazout=htmlspecialchars($_POST['prix_mazout']);
   
    $req=$connexion->prepare("INSERT INTO prix (dates,prix_essence,prix_mazout) values (?,?,?)");
    $req->execute(array($date,$prix_essence,$prix_mazout)); 
     if($req)
     {
        $_SESSION['notif']="Enregistrement reussi";
        $_SESSION['color']='success';
        $_SESSION['icon']="check-circle-fill";
        header('location:../../views/prix.php');
    }
 }


?>