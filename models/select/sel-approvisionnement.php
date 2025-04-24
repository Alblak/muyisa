<?php 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-approvisionnement.php?id=$id";
    $bouton="Modifier";
    $titre="Modifier  une approvisionnement";
    
    $req=$connexion->prepare("SELECT * from approvisionnement where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}

else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT * from approvisionnement where id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
else{
    $action="../models/add/add-approvisionnement.php";
    $bouton="Enregistrer";
    $titre="Ajouter une  approvisionnement";

}

$SelData=$connexion->prepare("SELECT * from approvisionnement where supprimer=0");
$SelData->execute();

