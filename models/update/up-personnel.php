<?php
include_once('../../connexion/connexion.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' )
{
    $matricule=$_GET['matricule'];
    $nom=htmlspecialchars($_POST['nom']);
    $postnom=htmlspecialchars($_POST['postnom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $genre=htmlspecialchars($_POST['genre']);
    $telephone=htmlspecialchars($_POST['telephone']);
    $fonction=htmlspecialchars($_POST['fonction']);
    $salaire=htmlspecialchars($_POST['salaire']);
    $croppedImage = $_POST['croppedImage'];
    if(!is_numeric($telephone) && strlen($telephone)!=10)
    {
        $_SESSION['notif']="num incorrect";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header('location:../../views/personnel.php');
    }
    else if(strlen($telephone)!=10)
    {
        $_SESSION['notif']="nombre de chiffre  du matricule est incorrect";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header('location:../../views/personnel.php');
    }
    else
    {
        $sel=$connexion->prepare("SELECT * from personnel where  telephone=? and matricule!=? and supprimer=0 ");
        $sel->execute(array($telephone,$matricule));
        if($exist=$sel->fetch())
        {
            $_SESSION['notif']="L' personnel existe déjà";
            $_SESSION['color']='danger';
            $_SESSION['icon']="x-circle-fill";
            header("location:../../views/personnel.php?id=$id");
        }
        else
        {
            if ($croppedImage) 
                {
                    $uploadDir = '../../assets/img/personnel/'; 
                    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImage));
                    $fileName = time() . '.jpg'; 
                    $filePath = $uploadDir . $fileName;
                    if(file_put_contents($filePath, $imageData)) 
                    {
                        $req=$connexion->prepare("UPDATE personnel SET nom=?,postnom=?,prenom=?,photo=?,genre=?,telephone=?,fonction=?,salaire=? where  matricule=?");
                        $req->execute(array($nom,$postnom,$prenom,$fileName,$genre,$telephone,$fonction,$salaire,$matricule)); 

                        if($req){
                            $upload="../../assets/img/personnel/";
                            move_uploaded_file($_FILES['photo']['tmp_name'],$upload);
                            $_SESSION['notif']="Modification reussie";
                            $_SESSION['color']='success';
                            $_SESSION['icon']="check-circle-fill";
                            header('location:../../views/personnel.php');
                        }
                    }
                }
        }
    }
  
}

?>