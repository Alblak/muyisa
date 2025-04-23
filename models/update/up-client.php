<?php
include_once('../../connexion/connexion.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' )
{
    $numero=$_GET['numero'];
    $nom=htmlspecialchars($_POST['nom']);
    $postnom=htmlspecialchars($_POST['postnom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $genre=htmlspecialchars($_POST['genre']);
    $telephone=htmlspecialchars($_POST['telephone']);
    
    $croppedImage = $_POST['croppedImage'];
    if(!is_numeric($telephone) && strlen($telephone)!=10)
    {
        $_SESSION['notif']="numero incorrect";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header('location:../../views/client.php');
    }
    else if(strlen($telephone)!=10)
    {
        $_SESSION['notif']="nombre de chiffre  du numero est incorrect";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header('location:../../views/client.php');
    }
    else
    {
        $sel=$connexion->prepare("SELECT * from client where  telephone=? and numero!=? and supprimer=0 ");
        $sel->execute(array($telephone,$numero));
        if($exist=$sel->fetch())
        {
            $_SESSION['notif']="L' client existe déjà";
            $_SESSION['color']='danger';
            $_SESSION['icon']="x-circle-fill";
            header("location:../../views/client.php?id=$id");
        }
        else
        {
            if ($croppedImage) 
                {
                    $uploadDir = '../../assets/img/clients/'; 
                    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImage));
                    $fileName = time() . '.jpg'; 
                    $filePath = $uploadDir . $fileName;
                    if(file_put_contents($filePath, $imageData)) 
                    {
                        $req=$connexion->prepare("UPDATE client SET nom=?,postnom=?,prenom=?,photo=?,genre=?,telephone=? where  numero=?");
                        $req->execute(array($nom,$postnom,$prenom,$fileName,$genre,$telephone,$numero)); 

                        if($req){
                            $upload="../../assets/img/clients/";
                            move_uploaded_file($_FILES['photo']['tmp_name'],$upload);
                            $_SESSION['notif']="Modification reussie";
                            $_SESSION['color']='success';
                            $_SESSION['icon']="check-circle-fill";
                            header('location:../../views/client.php');
                        }
                    }
                }
        }
    }
  
}

?>