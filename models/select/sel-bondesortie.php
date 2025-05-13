<?php 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-bondesortie.php?id=$id";
    $bouton="Modifier";
    $titre="Modifier bondesortie";
    
    $req=$connexion->prepare("SELECT * from bondesortie where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}

else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT * from bondesortie where id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
else{
    $action="../models/add/add-bondesortie.php";
    $bouton="Enregistrer";
    $titre="Ajouter bondesortie";

}

$SelData=$connexion->prepare("SELECT * from bondesortie where supprimer=0");
$SelData->execute();

