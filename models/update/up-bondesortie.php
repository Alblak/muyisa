<?php
include_once('../../connexion/connexion.php');
if(isset($_POST['valider']))

{
    $id=$_GET['id'];
    $libelle=htmlspecialchars($_POST['libelle']);
    $montant=htmlspecialchars($_POST['montant']);

   
        $req=$connexion->prepare("UPDATE  bondesortie set libelle=?,montant=? where id=?");
        $req->execute(array($libelle,$montant,$id)); 
         if($req)
         {
            $_SESSION['notif']="modification reussie";
            $_SESSION['color']='success';
            $_SESSION['icon']="check-circle-fill";
            header('location:../../views/bondesortie.php');
        }
    
}



?>