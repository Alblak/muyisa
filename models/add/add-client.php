<?php 
include('../../connexion/connexion.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
    
    $nom=htmlspecialchars($_POST['nom']);
    $postnom=htmlspecialchars($_POST['postnom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $genre=htmlspecialchars($_POST['genre']);
    $telephone=htmlspecialchars($_POST['telephone']);
    $numero="";
    if(!is_numeric($telephone))
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
        $croppedImage = $_POST['croppedImage'];
        $sel=$connexion->prepare("SELECT * from client where telephone=? and supprimer=0 ");
        $sel->execute(array($telephone));
        if($exist=$sel->fetch())
        {
            $_SESSION['notif']="ce  client  existe déjà";
            $_SESSION['color']='danger';
            $_SESSION['icon']="x-circle-fill";
            echo strlen($telephone);
            header('location:../../views/client.php');
        }
        else
        {

                $sellastClient=$connexion->prepare("SELECT * from client order by numero desc  limit 1");
                $sellastClient->execute();
                if($lastClient=$sellastClient->fetch())
                {
                    $numero="ME".sprintf('%04d', substr($lastClient['numero'],2)+1);
                }
                else 
                {
                    $numero="ME0001";
                }
                echo $numero;
                if ($croppedImage) 
                {
                    $uploadDir = '../../assets/img/clients/'; 
                    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImage));
                    $fileName = time() . '.jpg'; 
                    $filePath = $uploadDir . $fileName;
                    if(file_put_contents($filePath, $imageData)) 
                    {
                            $req=$connexion->prepare("INSERT INTO client (numero,nom,postnom,prenom,photo,genre,telephone) values (?,?,?,?,?,?,?)");
                            $req->execute(array($numero,$nom,$postnom,$prenom,$fileName,$genre,$telephone)); 


                            if($req){
                                $upload="../../assets/img/clients/";
                                move_uploaded_file($_FILES['photo']['tmp_name'],$upload);
                        
                                $_SESSION['notif']="Enregistrement reussi";
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