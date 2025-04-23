<?php
include_once('../../connexion/connexion.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' )
{
    $id=$_GET['id'];
    $nom=htmlspecialchars($_POST['nom']);
    $postnom=htmlspecialchars($_POST['postnom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $fonction=htmlspecialchars($_POST['fonction']);
    $motdepasse=htmlspecialchars($_POST['motdepasse']);
    $username=$prenom.$postnom.".@me.drc";
    
    $croppedImage = $_POST['croppedImage'];

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
        if ($croppedImage) 
            {
                $uploadDir = '../../assets/img/profils/'; 
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImage));
                $fileName = time() . '.jpg'; 
                $filePath = $uploadDir . $fileName;
                if(file_put_contents($filePath, $imageData)) 
                {
                    $req=$connexion->prepare("UPDATE utilisateur SET nom=?,postnom=?,prenom=?,fonction=?,photo=?,username=?,password=? where  id=?");
                    $req->execute(array($nom,$postnom,$prenom,$fonction,$fileName,$username,$motdepasse,$id));

                    if($req){
                        $upload="../../assets/img/profils/";
                        move_uploaded_file($_FILES['photo']['tmp_name'],$upload);
                        $_SESSION['notif']="Modification reussie";
                        $_SESSION['color']='success';
                        $_SESSION['icon']="check-circle-fill";
                        header('location:../../views/utilisateur.php');
                    }
                }
            }
    }
}

?>