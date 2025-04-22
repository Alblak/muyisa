<?php
include_once('../../connexion/connexion.php');
if(isset($_POST['valider']))
{
    $id=$_GET['id'];
    $nom=htmlspecialchars($_POST['nom']);
    $postnom=htmlspecialchars($_POST['postnom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $fonction=htmlspecialchars($_POST['fonction']);
    $motdepasse=htmlspecialchars($_POST['motdepasse']);
    $username=$prenom.$postnom.".@me.drc";
    
    $photo=$_FILES['photo']['name'];

    $sel=$connexion->prepare("SELECT * from utilisateur where nom=? AND postnom=? AND prenom=?  AND fonction=? ");
    $sel->execute(array($nom,$postnom,$prenom,$fonction));
    if($exist=$sel->fetch())
    {
        $_SESSION['notif']="L' utilisateur existe déjà";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header("location:../../views/utilisateur.php?id=$id");
    }
    else
    {
        $req=$connexion->prepare("UPDATE utilisateur SET nom=?,postnom=?,prenom=?,fonction=?,photo=?,username=?,password=? where  id=?");
        $req->execute(array($nom,$postnom,$prenom,$fonction,$photo,$username,$motdepasse,$id));

        if($req){
            $_SESSION['notif']="Modification reussie";
            $_SESSION['color']='success';
            $_SESSION['icon']="check-circle-fill";
            header('location:../../views/utilisateur.php');
        }
    }
}

?>