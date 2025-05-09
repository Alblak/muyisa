<?php 
include('../../connexion/connexion.php');


if (isset($_POST["valider"])) 
{
    
    $nom=htmlspecialchars($_POST['nom']);
    $postnom=htmlspecialchars($_POST['postnom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $adresse=htmlspecialchars($_POST['adresse']);
    $telephone=htmlspecialchars($_POST['telephone']);

    $sel=$connexion->prepare("SELECT * from fournisseur where telephone=?");
    $sel->execute(array($telephone));
    if($exist=$sel->fetch())
    {
        $_SESSION['notif']="ce  fournisseur  existe déjà";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header('location:../../views/fournisseur.php');
    }
    else
    {
          
        $req=$connexion->prepare("INSERT INTO fournisseur (nom,postnom,prenom,adresse,telephone) values (?,?,?,?,?)");
        $req->execute(array($nom,$postnom,$prenom,$adresse,$telephone)); 
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