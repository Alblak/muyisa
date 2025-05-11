<?php 

if(isset($_GET['matricule']))
{
    $id=$_GET['matricule'];
    $action="../models/update/up-personnel.php?matricule=$id";
    $bouton="Modifier";
    $titre="Modifier personnel";
    
    $req=$connexion->prepare("SELECT * from personnel where matricule=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}

else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT * from personnel where matricule=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
else{
    $action="../models/add/add-personnel.php";
    $bouton="Enregistrer";
    $titre="Ajouter personnel";

}

$SelData=$connexion->prepare("SELECT * from personnel where supprimer=0");
$SelData->execute();

