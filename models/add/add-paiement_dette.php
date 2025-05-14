<?php include('../../connexion/connexion.php');
if (isset($_POST["valider"])) 
{
    $date=date("Y-m-d");
    $commande=$_GET['idcom'];
    $montant=htmlspecialchars($_POST['montant']);
    $req=$connexion->prepare("INSERT INTO paiment_dette (dates,commande,montant) values (?,?,?)");
    $req->execute(array($date,$commande,$montant)); 
     if($req)
     {
        $_SESSION['notif']="Enregistrement reussi";
        $_SESSION['color']='success';
        $_SESSION['icon']="check-circle-fill";
        header('location:../../views/paiement_dette.php');
    }
 }


?>