<?php 
include('../../connexion/connexion.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
    $date=date('Y-m-d');
    $nom=htmlspecialchars($_POST['nom']);
    $postnom=htmlspecialchars($_POST['postnom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $genre=htmlspecialchars($_POST['genre']);
    $telephone=htmlspecialchars($_POST['telephone']);
    $fonction=htmlspecialchars($_POST['fonction']);
    $salaire=htmlspecialchars($_POST['salaire']);
    $matricule="";
    if(!is_numeric($telephone))
    {
        $_SESSION['notif']="matricule incorrect";
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
        $croppedImage = $_POST['croppedImage'];
        $sel=$connexion->prepare("SELECT * from personnel where telephone=? and supprimer=0 ");
        $sel->execute(array($telephone));
        if($exist=$sel->fetch())
        {
            $_SESSION['notif']="ce  personnel  existe déjà";
            $_SESSION['color']='danger';
            $_SESSION['icon']="x-circle-fill";
            echo strlen($telephone);
            header('location:../../views/personnel.php');
        }
        else
        {

                $sellastClient=$connexion->prepare("SELECT * from personnel order by matricule desc  limit 1");
                $sellastClient->execute();
                if($lastClient=$sellastClient->fetch())
                {
                    $matricule="AG-".sprintf('%04d', substr($lastClient['matricule'],3)+1);
                }
                else 
                {
                    $matricule="AG-0001";
                }
                echo $matricule;
                if ($croppedImage) 
                {
                    $uploadDir = '../../assets/img/personnel/'; 
                    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImage));
                    $fileName = time() . '.jpg'; 
                    $filePath = $uploadDir . $fileName;
                    if(file_put_contents($filePath, $imageData)) 
                    {
                            $req=$connexion->prepare("INSERT INTO personnel (matricule,nom,postnom,prenom,photo,genre,telephone,fonction,salaire,date_embauche) values (?,?,?,?,?,?,?,?,?,?)");
                            $req->execute(array($matricule,$nom,$postnom,$prenom,$fileName,$genre,$telephone,$fonction,$salaire,$date)); 


                            if($req){
                                $upload="../../assets/img/personnel/";
                                move_uploaded_file($_FILES['photo']['tmp_name'],$upload);
                        
                                $_SESSION['notif']="Enregistrement reussi";
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