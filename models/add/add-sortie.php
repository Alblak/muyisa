<?php
include("../../connexion/connexion.php");
if(isset($_POST['valider_new']))
{

    $sel_lastnum=$connexion->prepare("SELECT numfacture from commande order by  id desc limit 1");
    $sel_lastnum->execute();
    $numfacutre=0;
    if($last=$sel_lastnum->fetch())
    {
        $numfacutre=$last['numfacture']+1;
       
    }
    else
    {
        $numfacutre=1;
       
    }

    $type_vente=htmlspecialchars($_POST['type']);
    $date=date('Y-m-d');
    $client=$_GET['client'];
    $req=$connexion->prepare("INSERT INTO commande(dates,client,type,numfacture) values (?,?,?,?)");
    $req->execute(array($date,$client,$type_vente,$numfacutre));
    if($req)
    {
        $sel_com=$connexion->prepare("SELECT commande.*,client.nom,client.postnom,client.prenom from client,commande where commande.client=client.numero and commande.dates=? and  commande.client=? order by commande.id desc LIMIT 1");
        $sel_com->execute(array($date,$client));
        $com=$sel_com->fetch();
        $idcom=$com['id'];
        header("location:../../views/sortie.php?new&com=$idcom");
    }
}

if (isset($_POST['valider'])){
    $type=htmlspecialchars($_POST['type']);
    $type_achat=htmlspecialchars($_POST['type_achat']);
    $quantite=htmlspecialchars( $_POST['qte']);
    $commande=$_GET['com'];
    $prix=0;
    $stock=0;
    if($type=="essence")
    {
        $stock=$_SESSION['stock_essence'];
        if($type_achat=='litre')
        {
            $prix= $_SESSION['prix_essenceL'];
        }
        else
        {
            $prix= $_SESSION['prix_essenceF'];
        }
    }
    else
    {
        $stock=$_SESSION['stock_mazout'];
        if($type_achat=='litre')
        {
            $prix= $_SESSION['prix_mazoutL'];
        }
        else
        {
            $prix= $_SESSION['prix_mazoutF'];
        }
    }
    


   
  

    if($stock<$quantite)
    {
        $_SESSION['notif']="stock insuffisant, le stock disponible pour se type est de $stock pieces";
        header("location:../../views/sortie.php?com=$commande");
    }
    else
    {
        $sel_prod=$connexion->prepare("SELECT * FROM panier where commande=? and type=? and type_achat=?");
        $sel_prod->execute(array($commande,$type,$type_achat));
        if($exist=$sel_prod->fetch())
        {
            $quantite_up=$exist['quantite']+$quantite;
            echo $quantite_up;
            $up_quantite=$connexion->prepare("UPDATE panier set quantite=? where commande=? and type=? and type_achat=?");
            $up_quantite->execute(array($quantite_up,$commande,$type,$type_achat));
            if($up_quantite)
            {
                $_SESSION['notif']="Une quantite vient d'etre ajouter dans le panier";
                $_SESSION['color']='success';
                $_SESSION['icon']="check-circle-fill";
                header("location:../../views/sortie.php?com=$commande");
            }
        }
        else
        {
            $req=$connexion->prepare("INSERT into panier(commande,type,type_achat,quantite,prixunitaire) values (?,?,?,?,?)");
            $req->execute(array($commande,$type,$type_achat,$quantite,$prix));
            if($req)
            {
                $_SESSION['notif']="Un element vient d'etre ajouter dans le panier";
                $_SESSION['color']='success';
                $_SESSION['icon']="check-circle-fill";
                header("location:../../views/sortie.php?com=$commande");
            }
        }
    }   

   

    
    
}


?>