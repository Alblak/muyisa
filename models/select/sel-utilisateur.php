<?php 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-utilisateur.php?id=$id";
    $bouton="Modifier";
    $titre="Modifier utilisateur";
    
    $req=$connexion->prepare("SELECT * from utilisateur where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}

else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT * from utilisateur where id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
else{
    $action="../models/add/add-utilisateur.php";
    $bouton="Enregistrer";
    $titre="Ajouter utilisateur";

}

$SelData=$connexion->prepare("SELECT * from utilisateur where supprimer=0");
$SelData->execute();

