<?php 
include('../../connexion/connexion.php');
if(isset($_GET['iddelcom']))
{
    $id=$_GET['iddelcom'];
    $req=$connexion->prepare("DELETE FROM commande where id=?");
    $req->execute(array($id));
    if($req){
        $reqq=$connexion->prepare("DELETE FROM panier where commande=?");
        $reqq->execute(array($id));
        $_SESSION['notif']="suppression  reussie";
        header("location:../../views/sortie.php");
    }
}
if(isset($_GET['iddelpanier']))
{
        $id=$_GET['iddelpanier'];
        $req=$connexion->prepare("DELETE FROM panier where id=?");
        $req->execute(array($id));
        $_SESSION['notif']="suppression  reussie";
        header("location:../../views/sortie.php");
    
}

if(isset($_GET['cancel']))
{

    $id=$_GET['cancel'];
    $req=$connexion->prepare("DELETE FROM commande where id=?");
    $req->execute(array($id));
    if($req)
    {
        $reqq=$connexion->prepare("DELETE FROM panier where commande=?");
        $reqq->execute(array($id));
        $_SESSION['notif']="une commande a ete annuler";
        header("location:../../views/sortie.php");

    }
}