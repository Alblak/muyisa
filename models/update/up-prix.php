<?php
include_once('../../connexion/connexion.php');
if(isset($_POST['valider']))

{
    $id=$_GET['id'];
    $date=date("Y-m-d");
    $prix_essence=htmlspecialchars($_POST['prix_essence']);
    $prix_mazout=htmlspecialchars($_POST['prix_mazout']);

    $sel=$connexion->prepare("SELECT * from prix  order by id desc limit 1");
    $sel->execute();
    $exist=$sel->fetch();
    
    if($exist['prix_essence']==$prix_essence && $exist['prix_mazout']==$prix_mazout)
    {
        $_SESSION['notif']="Vous n'avez pas mis a jour le jour car vous avez saisi le meme prix ";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header("location:../../views/prix.php?id=$id");
    }
    else
    {
     
   
    $req=$connexion->prepare("INSERT INTO prix (dates,prix_essence,prix_mazout) values (?,?,?)");
    $req->execute(array($date,$prix_essence,$prix_mazout)); 
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