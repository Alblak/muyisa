<?php
include_once('../../connexion/connexion.php');
if(isset($_POST['valider']))

{
    $id=$_GET['id'];
    $date=date("Y-m-d");
    $prix_essenceL=htmlspecialchars($_POST['prix_essenceL']);
    $prix_mazoutL=htmlspecialchars($_POST['prix_mazoutL']);
    $prix_essenceF=htmlspecialchars($_POST['prix_essenceF']);
    $prix_mazoutF=htmlspecialchars($_POST['prix_mazoutF']);

    $sel=$connexion->prepare("SELECT * from prix  order by id desc limit 1");
    $sel->execute();
    $exist=$sel->fetch();
    
    if($exist['prix_essenceL']==$prix_essenceL && $exist['prix_mazoutL']==$prix_mazoutL && $exist['prix_essenceF']==$prix_essenceF && $exist['prix_mazoutF']==$prix_mazoutF)
    {
        $_SESSION['notif']="Vous n'avez pas mis a jour le jour car vous avez saisi le meme prix ";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header("location:../../views/prix.php?id=$id");
    }
    else
    {
     
   
        $req=$connexion->prepare("INSERT INTO prix (dates,prix_essenceL,prix_mazoutL,prix_essenceF,prix_mazoutF) values (?,?,?,?,?)");
        $req->execute(array($date,$prix_essenceL,$prix_mazoutL,$prix_essenceF,$prix_mazoutF)); 
         if($req)
         {
            $_SESSION['notif']="mise a jour reussi";
            $_SESSION['color']='success';
            $_SESSION['icon']="check-circle-fill";
            header('location:../../views/prix.php');
        }
    }
}



?>