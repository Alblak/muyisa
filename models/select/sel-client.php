<?php 

if(isset($_GET['numero']))
{
    $id=$_GET['numero'];
    $action="../models/update/up-client.php?numero=$id";
    $bouton="Modifier";
    $titre="Modifier client";
    
    $req=$connexion->prepare("SELECT * from client where numero=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}

else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT * from client where numero=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
else{
    $action="../models/add/add-client.php";
    $bouton="Enregistrer";
    $titre="Ajouter client";

}

$SelData=$connexion->prepare("SELECT * from client where supprimer=0");
$SelData->execute();

