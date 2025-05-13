<?php 
$annee=date('Y');
$salaire=0;
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-remuneration.php?id=$id";
    $bouton="Modifier";
    $titre="Modifier l'remuneration";
    
    $req=$connexion->prepare("SELECT * from remuneration where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}
else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT commande.id,client.numero,client.nom,client.postnom,client.prenom,commande.dates from client,commande where client.numero=commande.client and commande.supprimer=0 AND commande.id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
if(isset($_GET['idexp'])){
    $idexp=$_GET['idexp'];
    $action="../models/add/add-remuneration.php?idexp=$idexp";
    $bouton="Enregistrer";
    $titre="Ajouter remuneration";
}
 if(isset($_GET['search']))
 {
     $recherche=$_GET['search'];
     $SelPerso=$connexion->prepare("SELECT * From personnel where supprimer=0 and ( personnel.nom   LIKE ? OR personnel.postnom  LIKE ? OR personnel.prenom  LIKE ? OR personnel.numero LIKE ?)");
     $SelPerso->execute(["%".$recherche."%","%".$recherche."%","%".$recherche."%","%".$recherche."%"]); 
     $message="Aucun element correspond  a votre recherche";
     
 }
 else{
     $SelPerso=$connexion->prepare("SELECT * From personnel where supprimer=0");
     $SelPerso->execute();
     $message="Veillez ajouter le client d'abord dans le menu approprier";
 }



if(isset($_GET['idperso']))
{
    $personnel=$_GET['idperso'];
    $salaire=$_GET['salaire'];
    $sel_mois=$connexion->prepare("SELECT mois.* from mois where (mois.id) not in(select mois from remuneration where personnel=? and annee=? GROUP BY mois HAVING SUM(montant)=? )");
    $sel_mois->execute(array($personnel,$annee,$salaire));
}

if(isset($_GET['idpersonnel']))
{
    

    $matricule=$_GET['idpersonnel'];
    $mois=$_GET['idmois'];
    $action="../models/add/add-remuneration.php?idpersonnel=$matricule";
    $bouton="Enregistrer";
    $titre="Ajouter remuneration";
    $sel_Perso=$connexion->prepare("SELECT * from personnel where matricule =?");
    $sel_Perso->execute(array($matricule));
    $detail=$sel_Perso->fetch();
    $sel_mois_conc=$connexion->prepare("SELECT mois.mois from mois where id=?");
    $sel_mois_conc->execute(array($mois));
    $detail_mois=$sel_mois_conc->fetch();
    $sel_montant_payer=$connexion->prepare("SELECT sum(montant) as total from remuneration where mois and personnel=? and mois=? and annee=?");
    $sel_montant_payer->execute(array($matricule,$mois,$annee));
    $montant_payer_tot=$sel_montant_payer->fetch();
    $montant_payer=$montant_payer_tot['total'];
    if($montant_payer!="" && $montant_payer!=0)
    {
        $montant_payer=$montant_payer;
    }
    else
    {
        $montant_payer=0;
    }
   

    $reste=$salaire-$montant_payer;


}
$SelData=$connexion->prepare("SELECT  remuneration.*,personnel.*,mois.mois as mmois from remuneration ,personnel,mois  where mois.id=remuneration.mois and  remuneration.personnel=personnel.matricule ORDER BY remuneration.id DESC");
$SelData->execute();




