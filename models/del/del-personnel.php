<?php include_once('../../connexion/connexion.php');
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $supprimer=1;
    $req=$connexion->prepare("UPDATE  personnel SET supprimer=? where matricule=?");
    $req->execute(array($supprimer,$id));
    if($req)
    {
        $_SESSION['notif']="Suppression  reussie";
        $_SESSION['color']='success';
        $_SESSION['icon']="trash3-fill";
        header('location:../../views/personnel.php');
    }
}
?>