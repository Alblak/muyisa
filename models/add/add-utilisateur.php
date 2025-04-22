<?php 
include('../../connexion/connexion.php');
if (isset($_POST["valider"])) {
    $annee=date("Y");
    $nom=htmlspecialchars($_POST['nom']);
    $postnom=htmlspecialchars($_POST['postnom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $fonction=htmlspecialchars($_POST['fonction']);
    $motdepasse=htmlspecialchars($_POST['motdepasse']);
    $username=$prenom.$postnom.".@me.drc";
    
    $photo=$_FILES['photo']['name'];
    
    $sel=$connexion->prepare("SELECT * from utilisateur where nom=? AND postnom=? AND prenom=?  ");
    $sel->execute(array($nom,$postnom,$prenom));
    if($exist=$sel->fetch())
    {
        $_SESSION['notif']="ce  utilisateur  existe déjà";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header('location:../../views/utilisateur.php');
    }
    else
    {
        $req=$connexion->prepare("INSERT INTO utilisateur (nom,postnom,prenom,fonction,photo,username,password) values (?,?,?,?,?,?,?)");
        $req->execute(array($nom,$postnom,$prenom,$fonction,$photo,$username,$motdepasse)); 


        if($req){
            $upload="../../assets/img/profils/";
            move_uploaded_file($_FILES['photo']['tmp_name'],$upload);
       
            $_SESSION['notif']="Enregistrement reussi";
            $_SESSION['color']='success';
            $_SESSION['icon']="check-circle-fill";
            header('location:../../views/utilisateur.php');
        }
    }
}

?>