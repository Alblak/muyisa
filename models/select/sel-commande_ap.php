<?php 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-commande_ap.php?id=$id";
    $bouton="Modifier";
    $titre="Modifier  une commande_ap";
    
    $req=$connexion->prepare("SELECT * from commande_ap where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}

else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT * from commande_ap where id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
else{
    $action="../models/add/add-commande_ap.php";
    $bouton="Enregistrer";
    $titre="Ajouter une  commande_ap";

}


if(isset($_GET['com']))
{
    

    $idd=$_GET['com'];
    $action="../models/add/add-sortie.php?com=$idd";
    $bouton="Enregistrer";
    $titre="Ajouter sortie";
    $sel_cl=$connexion->prepare("SELECT commande_ap.*,fournisseur.* from commande_ap,fournisseur  where commande_ap.fournisseur=fournisseur.id AND commande_ap.id=?");
    $sel_cl->execute(array($idd));
    $detail=$sel_cl->fetch();
   
    $Selpanier=$connexion->prepare("SELECT * from panier_ap where commande=?");
    $Selpanier->execute(array($idd));
}


$SelData=$connexion->prepare("SELECT commande_ap.*,fournisseur.nom,fournisseur.postnom,fournisseur.prenom from commande_ap,fournisseur  where commande_ap.fournisseur=fournisseur.id AND commande_ap.supprimer=0");
$SelData->execute();

$SelFour=$connexion->prepare("SELECT * from fournisseur where supprimer=0");
$SelFour->execute();

