<?php
include_once('../../connexion/connexion.php');
if(isset($_POST['valider']))

{
    $id=$_GET['id'];
    $quantite=htmlspecialchars($_POST['quantite']);
    $montant=htmlspecialchars($_POST['montant']);

    $sel=$connexion->prepare("SELECT * from approvisionnement  where  id=?");
    $sel->execute(array($id));
    $exist=$sel->fetch();
    
    if($exist['quantite']==$quantite &&  $exist['montant']==$montant)
    {
        $_SESSION['notif']="Vous n'avez effectuer aucune modification ";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header("location:../../views/approvisionnement.php?id=$id");
    }
    else
    {
        $req=$connexion->prepare("UPDATE  approvisionnement  SET quantite=?,montant=? where id=?");
        $req->execute(array($quantite,$montant,$id)); 
         if($req)
         {
            $_SESSION['notif']="modification  reussie";
            $_SESSION['color']='success';
            $_SESSION['icon']="check-circle-fill";
            header('location:../../views/approvisionnement.php');
        }
    }
}



?>