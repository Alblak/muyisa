<?php
include_once('../../connexion/connexion.php');
if(isset($_POST['valider']))

{
    $id=$_GET['id'];
   $date=date("Y-m-d");

   $sel_exist=$connexion->prepare("SELECT * from prix where id=?");
   $sel_exist->execute(array($id));
   $exist=$sel_exist->fetch();

    $prix_detail=htmlspecialchars($_POST['prix_detail']);
    $prix_gros=htmlspecialchars($_POST['prix_gros']);
    $type=$exist['type'];
     $entree=$exist['entree'];

    $req=$connexion->prepare("INSERT INTO prix (dates,type,prix_detail,prix_gros,entree) values (?,?,?,?,?)");
    $req->execute(array($date,$type,$prix_detail,$prix_gros,$entree,)); 
     if($req)
     {
        $_SESSION['notif']="modification  reussie";
        $_SESSION['color']='success';
        $_SESSION['icon']="check-circle-fill";
        header('location:../../views/prix.php');
    }
}



?>