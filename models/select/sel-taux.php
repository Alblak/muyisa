<?php 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-taux.php?id=$id";
    $bouton="mettre à jour";
    $titre="mettre à jour le  taux";
    
    $req=$connexion->prepare("SELECT * from taux where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}

else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT * from taux where id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
else{
    $action="../models/add/add-taux.php";
    $bouton="Enregistrer";
    $titre="Ajouter le taux";

}

$SelData=$connexion->prepare("SELECT * from taux order by id desc ");
$SelData->execute();


$Sellast=$connexion->prepare("SELECT * from taux order by id desc limit 1");
$Sellast->execute();
$compt=0;
if($last=$Sellast->fetch())
{
    $compt=1;
}



