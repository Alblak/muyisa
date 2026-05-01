<?php include_once('../../connexion/connexion.php');
if(isset($_GET['iddel']))
{
    $id=$_GET['iddel'];
    $req=$connexion->prepare("DELETE FROM  remuneration where id=?");
    $req->execute(array($id));
    if($req)
    {
        $_SESSION['notif']="Suppression  reussie";
        $_SESSION['color']='success';
        $_SESSION['icon']="trash3-fill";
        header('location:../../views/remuneration.php');
    }
}
?>