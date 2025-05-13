<?php
try {
session_start();	
$connexion=new PDO('mysql:dbname=muyisa_energie; host=localhost', 'root', '');
} catch (Exception $e) {
	echo $e;
	
}
$sel_reste=$connexion->prepare("SELECT sum(reste_argent) as total from entree  where supprimer=0");
$sel_reste->execute();
if($total_reste=$sel_reste->fetch())
{
	$total_reste=$total_reste['total'];
}
else
{
	$total_reste=0;
}

$sel_tot_sortie=$connexion->prepare("SELECT sum(panier.prixunitaire*panier.quantite) as total from panier,commande where panier.commande=commande.id and commande.supprimer=0;");
$sel_tot_sortie->execute();
if($tot_sortie=$sel_tot_sortie->fetch())
{
	$total_sortie=$tot_sortie['total'];

}
else
{
	$total_sortie=0;
}
$sel_tot_appro=$connexion->prepare("SELECT sum(panier_ap.prixunitaire*panier_ap.quantite) as total from panier_ap,commande_ap where panier_ap.commande=commande_ap.id and commande_ap.supprimer=0");
$sel_tot_appro->execute();
if($tot_appro=$sel_tot_appro->fetch())
{
	$total_appro=$tot_appro['total'];
}
else
{	
	$total_appro=0;
	
}

$sel_tot_remuneration=$connexion->prepare("SELECT sum(montant) as total from remuneration  where supprimer=0");
$sel_tot_remuneration->execute();
if($total_remuneration=$sel_tot_remuneration->fetch())
{
	$total_remuneration=$total_remuneration['total'];
}
else
{
	$total_remuneration=0;
}	

$sel_bondesortie=$connexion->prepare("SELECT sum(montant ) as total from bondesortie  where supprimer=0");
$sel_bondesortie->execute();
if($total_bondesortie=$sel_bondesortie->fetch())
{
	$total_bondesortie=$total_bondesortie['total'];
}
else
{
	$total_bondesortie=0;
}





$_SESSION['caisse']=$total_reste+$total_sortie-$total_remuneration-$total_appro-$total_bondesortie;
?>