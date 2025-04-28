<?php 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-sortie.php?id=$id";
    $bouton="Modifier";
    $titre="Modifier l'sortie";
    
    $req=$connexion->prepare("SELECT * from sortie where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}
else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT sortie.id,client.numero,client.nom,client.postnom,client.prenom,sortie.datesortie,sortie.quantite,sortie.prix from client,sortie where client.numero=sortie.cacaoculteur and sortie.supprimer=0 AND sortie.id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
if(isset($_GET['idexp'])){
    $idexp=$_GET['idexp'];
    $action="../models/add/add-sortie.php?idexp=$idexp";
    $bouton="Enregistrer";
    $titre="Ajouter sortie";
}
 if(isset($_GET['search']))
 {
     $recherche=$_GET['search'];
     $SelClient=$connexion->prepare("SELECT * From client where  client.supprimer=0 and  client.nom   LIKE ? OR client.postnom  LIKE ? OR client.prenom  LIKE ? OR client.numero LIKE ?");
     $SelClient->execute(["%".$recherche."%","%".$recherche."%","%".$recherche."%","%".$recherche."%"]); 
     $message="Aucun element correspond  a votre recherche";
     
 }
 else{
     $SelClient=$connexion->prepare("SELECT * From client where supprimer=0");
     $SelClient->execute();
     $message="Veillez ajouter le client d'abord dans le menu approprier";
 }


 $sel_sortieEF=$connexion->prepare("SELECT SUM(quantite) as quantite from panier where supprimer=0 and type='essence' and type_achat='fut'");
 $sel_sortieEF->execute();
 if($sortie=$sel_sortieEF->fetch())
 {
     $quantite_sortieEF=$sortie['quantite']*207;
 }
 else
 {
     $quantite_sortieEF=0;
 }



$sel_sortieEL=$connexion->prepare("SELECT SUM(quantite) as quantite from panier where supprimer=0 and type='essence' and type_achat='litre'");
$sel_sortieEL->execute();
if($sortie=$sel_sortieEL->fetch())
{
    $quantite_sortieEL=$sortie['quantite'];
}
else
{
    $quantite_sortieEL=0;
}
$quantite_sortieE=$quantite_sortieEF+$quantite_sortieEL;

$sel_sortieMF=$connexion->prepare("SELECT SUM(quantite) as quantite from panier where supprimer=0 and type='mazout' and type_achat='fut'");
$sel_sortieMF->execute();
if($sortie=$sel_sortieMF->fetch())
{
    $quantite_sortieMF=$sortie['quantite']*207;
}
else
{
    $quantite_sortieMF=0;
}


$sel_sortieML=$connexion->prepare("SELECT SUM(quantite) as quantite from panier where supprimer=0 and type='mazout' and type_achat='litre'");
$sel_sortieML->execute();
if($sortie=$sel_sortieML->fetch())
{
    $quantite_sortieML=$sortie['quantite'];
}
else
{
    $quantite_sortieML=0;
}
$quantite_sortieM=$quantite_sortieMF+$quantite_sortieML;

$sel_approvisionnementE=$connexion->prepare("SELECT SUM(quantite) as quantite from approvisionnement where type='essence' and supprimer=0");
$sel_approvisionnementE->execute();
$approvisionnementE=$sel_approvisionnementE->fetch();
if($approvisionnementE['quantite']<=0)
{
    $_SESSION['stock_essence']=0;
}
else
{
    $quantite_approvisionnementE=$approvisionnementE['quantite'];
    $_SESSION['stock_essence']=$quantite_approvisionnementE-$quantite_sortieE;
}

$sel_approvisionnementM=$connexion->prepare("SELECT SUM(quantite) as quantite from approvisionnement where type='mazout' and supprimer=0");
$sel_approvisionnementM->execute();
$approvisionnementM=$sel_approvisionnementM->fetch();
if($approvisionnementM['quantite']<=0)
{
    $_SESSION['stock_mazout']=0;
}
else
{
    $quantite_approvisionnementM=$approvisionnementM['quantite'];
    $_SESSION['stock_mazout']=$quantite_approvisionnementM-$quantite_sortieM;
}



$SelData=$connexion->prepare("SELECT  commande.*,client.* from commande ,client  where commande.client=client.numero ORDER BY commande.id DESC");
$SelData->execute();
if(isset($_GET['com']))
{
    

    $idd=$_GET['com'];
    $action="../models/add/add-sortie.php?com=$idd";
    $bouton="Enregistrer";
    $titre="Ajouter sortie";
    $sel_cl=$connexion->prepare("SELECT commande.*,client.* from commande,client  where commande.client=client.numero AND commande.id=?");
    $sel_cl->execute(array($idd));
    $detail=$sel_cl->fetch();
   
    $Selpanier=$connexion->prepare("SELECT * from panier where commande=?");
    $Selpanier->execute(array($idd));
}


$Sellast=$connexion->prepare("SELECT * from prix order by id desc limit 1");
$Sellast->execute();
if($last=$Sellast->fetch())
{
    $_SESSION['prix_essenceL']=$last['prix_essenceL'];
    $_SESSION['prix_mazoutL']=$last['prix_mazoutL'];

    $_SESSION['prix_essenceF']=$last['prix_essenceF'];
    $_SESSION['prix_mazoutF']=$last['prix_mazoutF'];

}

