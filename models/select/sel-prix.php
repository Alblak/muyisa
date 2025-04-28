<?php 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-prix.php?id=$id";
    $bouton="mettre à jour";
    $titre="mettre à jour le  prix";
    
    $req=$connexion->prepare("SELECT * from prix where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}

else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT * from prix where id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
else{
    $action="../models/add/add-prix.php";
    $bouton="Enregistrer";
    $titre="Ajouter le prix";

}

$SelData=$connexion->prepare("SELECT * from prix order by id desc ");
$SelData->execute();


$Sellast=$connexion->prepare("SELECT * from prix order by id desc limit 1");
$Sellast->execute();
$compt=0;
if($last=$Sellast->fetch())
{
    $compt=1;
}



