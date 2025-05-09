<?php 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-fournisseur.php?id=$id";
    $bouton="Modifier";
    $titre="Modifier fournisseur";
    
    $req=$connexion->prepare("SELECT * from fournisseur where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}

else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT * from fournisseur where id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
else{
    $action="../models/add/add-fournisseur.php";
    $bouton="Enregistrer";
    $titre="Ajouter fournisseur";

}

$SelData=$connexion->prepare("SELECT * from fournisseur where supprimer=0");
$SelData->execute();

