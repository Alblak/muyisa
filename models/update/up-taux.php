<?php
include_once('../../connexion/connexion.php');
if(isset($_POST['valider']))

{
    $id=$_GET['id'];
    $date=date("Y-m-d");
    $equivalent=htmlspecialchars($_POST['equivalent']);

    $sel=$connexion->prepare("SELECT * from taux  order by id desc limit 1");
    $sel->execute();
    $exist=$sel->fetch();
    
    if($exist['equivalent']==$equivalent)
    {
        $_SESSION['notif']="Vous n'avez pas mis a jour le jour car vous avez saisi le meme taux ";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header("location:../../views/taux.php?id=$id");
    }
    else
    {
        $req=$connexion->prepare("INSERT INTO taux (dates,equivalent) values (?,?)");
        $req->execute(array($date,$equivalent)); 
         if($req)
         {
            $_SESSION['notif']="mise a jour reussi";
            $_SESSION['color']='success';
            $_SESSION['icon']="check-circle-fill";
            header('location:../../views/taux.php');
        }
    }
}



?>