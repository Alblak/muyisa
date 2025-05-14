<?php

if(isset($_GET['search']))
{
    $recherche=$_GET['search'];
    $SelClient=$connexion->prepare("SELECT * From client where  client.supprimer=0 and  (client.nom   LIKE ? OR client.postnom  LIKE ? OR client.prenom  LIKE ? OR client.numero LIKE ?)");
    $SelClient->execute(["%".$recherche."%","%".$recherche."%","%".$recherche."%","%".$recherche."%"]); 
    $message="Aucun element correspond  a votre recherche";
    
}
else{
    $SelClient=$connexion->prepare("SELECT * From client where supprimer=0");
    $SelClient->execute();
    $message="Veillez ajouter le client d'abord dans le menu approprier";
}



if(isset($_GET['idclient']))
{
    $client=$_GET['idclient'];
    $SelData=$connexion->prepare("SELECT  * from commande where commande.client=? ORDER BY commande.id DESC ");
    $SelData->execute(array($client));


    $sel_dette=$connexion->prepare("SELECT sum(panier.prixunitaire*panier.quantite) as total from panier,commande where panier.commande=commande.id and commande.supprimer=0 and commande.type=0 and commande.client=?");
    $sel_dette->execute(array($client));
    if($dette=$sel_dette->fetch())
    {
        $total_dette=$dette['total'];
    }
    else
    {
        $total_dette=0;
    }
    $SelDetail=$connexion->prepare("SELECT * from client where numero=?");
    $SelDetail->execute(array($client));
    $detail=$SelDetail->fetch();
}


?>