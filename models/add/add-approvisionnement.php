<?php 
include('../../connexion/connexion.php');
if (isset($_POST["valider"])) 
{
    $dates=date('Y-m-d');
    $quantite_essence=htmlspecialchars($_POST['quantite_essence']);
    $quantite_mazout=htmlspecialchars($_POST['quantite_mazout']);
    $commande=$_GET['com'];
    if($_SESSION['quantite_essence']>$quantite_essence)
    {
        $reste_E=$_SESSION['quantite_essence']-$quantite_essence;
        $reste_argent_essence=$reste_E *  $_SESSION['argent_essence'];
        echo "</br>".$reste_E. "x".$_SESSION['argent_essence']." = ".$reste_argent_essence;
    }
    else
    {
        $reste_E=0;
        $reste_argent_essence=0;
       
    }

    if($_SESSION['quantite_mazout']>$quantite_mazout)
    {
        $reste_M=$_SESSION['quantite_mazout']-$quantite_mazout;
        $reste_argent_mazout=$reste_M *  $_SESSION['argent_mazout'];
        echo "</br>".$reste_M. "x".$_SESSION['argent_mazout']." = ".$reste_argent_mazout;
       
    }
   else
   {
    $reste_M=0;
    $reste_argent_mazout=0;
    }
    $reste_argent_total=$reste_argent_mazout+$reste_argent_essence;
    echo "</br>";
  echo $reste_argent_essence." ".$reste_argent_mazout;
    $req=$connexion->prepare("INSERT INTO entree (dates,commande,quantite_essence,quantite_mazout,reste_argent) values (?,?,?,?,?)");
    $req->execute(array($dates,$commande,$quantite_essence,$quantite_mazout,$reste_argent_total)); 
     if($req)
     {
        $_SESSION['quantite_essence']=0;
        $_SESSION['quantite_mazout']=0;
        $_SESSION['notif']="Enregistrement reussi";
        $_SESSION['color']='success';
        $_SESSION['icon']="check-circle-fill";
        header('location:../../views/approvisionnement.php');
    }
 }


?>