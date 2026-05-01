<?php 
include('../../connexion/connexion.php');


if (isset($_POST["valider"])) 
{
    $id=$_GET['id'];
    
    $nom=htmlspecialchars($_POST['nom']);
    $postnom=htmlspecialchars($_POST['postnom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $adresse=htmlspecialchars($_POST['adresse']);
    $telephone=htmlspecialchars($_POST['telephone']);

    $sel=$connexion->prepare("SELECT * from fournisseur where telephone=? and id!=?");
    $sel->execute(array($telephone,$id));
    if($exist=$sel->fetch())
    {
        $_SESSION['notif']="ce  fournisseur  existe déjà";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header('location:../../views/fournisseur.php');
    }
    if(!is_numeric($telephone) && strlen($telephone)!=10)
    {
        $_SESSION['notif']="numero incorrect";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header('location:../../views/fournisseur.php');
    }
    else if(strlen($telephone)!=10)
    {
        $_SESSION['notif']="nombre de chiffre  du numero est incorrect";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header('location:../../views/fournisseur.php');
    }
    else
    {
          
        $req=$connexion->prepare("UPDATE   fournisseur SET nom=?,postnom=?,prenom=?,adresse=?,telephone=? where id=?");
        $req->execute(array($nom,$postnom,$prenom,$adresse,$telephone,$id)); 
        if($req)
        {
             $_SESSION['notif']="Enregistrement reussi";
             $_SESSION['color']='success';
             $_SESSION['icon']="check-circle-fill";
             header('location:../../views/fournisseur.php');
        }
               
         
    }
                
}

?>