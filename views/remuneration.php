<?php 
include('../connexion/connexion.php');
include_once('../models/select/sel-remuneration.php');
if(isset($_GET['personnel']))
{
   
    $mois=htmlspecialchars($_POST['mois']);
    header('location:remuneration.php?idpersonnel='.$_GET['personnel'].'&idmois='.$mois);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>remuneration  </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- link -->
    <?php 
    include_once('../include/link.php');
    
    ?>
  <!-- link -->
  
<!-- menu -->
<?php 
include_once('../include/menu.php');
?>

</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <main id="main" class="main">
        <div class="row " >
    
            <div class="col-120 bg-black position-fixed m-auto p-3">
            
                <h2 class=" text-white">remuneration </h2>
              
            </div><!-- End Page Title -->
       
        </div>
       
        
          <section class="section">
              <div class="row">
                  <div class="col-lg-12">

                      <div class=" p-3  m-3">
                          <div class="card-body ">
                    <?php      if(isset($_GET['idsup']) && ! empty($_GET['idsup'])){
                    ?>
                        <div class="col-12 h-100  d-flex justify-content-center align-items-center p-4">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 bg-black card p-3 shadow   m-3">
                                <div class="card-header text-dark d-flex justify-content-between">
                                    <b class="text-white">Supprimer</b>
                                    <a href="remuneration.php" class="btn btn-outline-danger text-white"><b><i class="bi bi-x"></i></b></a>
                                    
                                </div>
                                <div class="card-body py-3  text-white">
                                    Voulez-vous vraiment supprimer l'sortie de "<b> <?=$supprimer['nom']."  ".$supprimer['postnom']." d'une quantite de ".$supprimer['quantite']." L au prix de  ".$supprimer['prix']?> par L </b>"?
                                    <br>
                                    <em class="mt-3 text-danger">NB: cette action est irréversible</em>
                                </div>
                                <div class="card-footer">
                                    <a href='../models/del/del-remuneration.php?iddel=<?=$_GET['idsup'] ?>' class="btn btn-outline-danger">Supprimer</a>
                                    <a href="remuneration.php" class="btn btn-success">Annuler</a>
                                </div>
                            </div>
                        </div>
                    <?php
                }else { ?>
                            <?php if(isset($_GET['new']) && !isset($_GET['com'])){?>
                                <div class="shadow p-3 row">
                                    <center><h2>Choisir l'personnel</h2></center>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                                <label for=""></span></label>
                                                <a href="remuneration.php?fin"><input type="buttom" class="btn btn-success w-100" name="annuler " value="Annuler l'operation"></a>
                                        </div>
                                            
                                        <div class="col-xl-12 col-lg-12  p-3">
                                                <form class="search-form d-flex row "   method="get">
                                                            <input class="col-xl-10 col-lg-10 col-md-10  col-sm-10 p-3 m-1" required autocomplete="off" type="text" name="search" placeholder="Rechercher avec les noms de l'personnel" title="">
                                                            <input hidden type="text" name="new">
                                                            <button class="col-xl-1 col-lg-1 col-md-1  col-sm-1 p-3 m-1 btn btn-dark" type="submit" title="Search"><i class="bi bi-search "></i></button>
                                                    <?php if(isset($_GET['search'])){ ?>
                                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
                                                        <a href="remuneration.php?new"><input  class="btn btn-success "type="button" value="Voir tout"></a>
                                                    </div>
                                                    <?php } ?>
                                                </form>
                                        </div>
                                        <?php
                                            $nb=0;
                                            while($personnel= $SelPerso->fetch()){
                                                $nb++;
                                           
                                            ?>
                                        
                                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6  ">
                                                <a class=" btn btn-white shadow m-3 w-100" href="remuneration.php?idperso=<?=$personnel['matricule']?>&salaire=<?=$personnel['salaire']?>">
                                                    <div class=row>
                                                        
                                                        <div class="col-12">
                                                            <div class="row">
                                                               
                                                                <div class="col-12">
                                                                <b>Noms : </b><?=$personnel['nom'].' '.$personnel['postnom'].' '.$personnel['prenom']?>
                                                                </div>
                                                                <div class="col-12">
                                                                <b>Matricule : </b> <?=$personnel['matricule']?>
                                                                </div>
                                                                <div class="col-12">
                                                                <b>N° telephone : </b> <?=$personnel['telephone']?>
                                                                </div>
                                                              
                                                            
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    </a>
                                            </div>
                                    
                                        <?php } ?> 
                                                <?php if($nb==0){ ?>
                                                    <center><?=$message?></center>
                                               <?php } ?> 

                                        </div>
                                
                                </div>
                        

                            <?php }else if(isset($_GET['idperso'])){ ?>
                            
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
                                         <form  class="shadow  p-3 m-3" action="remuneration.php?personnel=<?=$_GET['idperso']?>" method="POST">
                                            <h5 class="card-title text-center "></h5>
                                            <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                                    <label for="">Choisir le mois </span></label>
                                                    <select name="mois" id="mois" class="form-select">
                                                        <?php while($mois=$sel_mois->fetch()){ ?>
                                                            <option value="<?=$mois['id']?>"><?=$mois['mois']?> </option>
                                                          
                                                        <?php } ?>
                                                    
                                                    </select>
                                                    
                                                </div>
                                               
                                                
                                                    
                                                    <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">


                                                        <?php if(isset($_SESSION['notif'])){ ?>
                                                            <center><p class="alert-<?=$_SESSION['color']?> alert">
                                                            <b> <i class="bi bi-<?=$_SESSION['icon']?>">  <?php echo $_SESSION['notif']; unset($_SESSION['notif']) ?></i></b>
                                                                    
                                                            </p></center> 
                                                        <?php } ?> 
                                                    </div>
                                                    
                                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 row">
                                                
                                                            <div class="col-xl-8 col-lg-8 col-md-8  col-sm-8">
                                                                <input type="submit" class="btn btn-success text-white p-2 mt-1 w-100" name="valider_new" value="suivant">
                                                            </div>
                                                            <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4">
                                                                <a href="remuneration.php" class="btn btn-dark p-2  mt-1 w-100">Annuler</a>
                                                            </div>
                                                        
                                                </div>
                                            </div>   
                        
                        
                                        </form>
                                    </div>
                                  
                                   
                                   </div>
                            
                                   <?php }else if(isset($_GET['idpersonnel'])){ ?>
                            
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6">
                                            <form  class="shadow  p-3 m-3" action="../models/add/add-remuneration.php?idpersonnel=<?=$_GET['idpersonnel']?>&idmois=<?=$_GET['idmois']?>" method="POST">
                                                <h5 class="card-title text-center "></h5>
                                                <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                                            <label for="">montant</span></label>
                                                            <input autocomplete="off" required type="number" step="0.01" max="<?=$detail['salaire']-$montant_payer?>"  class="form-control" placeholder="Ex:150"  name="montant" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['montant']?>" <?php } ?>> 
                                                        </div>
                                                    
                                                        
                                                        <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">


                                                            <?php if(isset($_SESSION['notif'])){ ?>
                                                                <center><p class="alert-<?=$_SESSION['color']?> alert">
                                                                <b> <i class="bi bi-<?=$_SESSION['icon']?>">  <?php echo $_SESSION['notif']; unset($_SESSION['notif']) ?></i></b>
                                                                        
                                                                </p></center> 
                                                            <?php } ?> 
                                                        </div>
                                                        
                                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 row">
                                                    
                                                                <div class="col-xl-8 col-lg-8 col-md-8  col-sm-8">
                                                                    <input type="submit" class="btn btn-success text-white p-2 mt-1 w-100" name="valider" value="enregistrer">
                                                                </div>
                                                                <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4">
                                                                    <a href="remuneration.php" class="btn btn-dark p-2  mt-1 w-100">Annuler</a>
                                                                </div>
                                                            
                                                    </div>
                                                </div>   
                            
                            
                                            </form>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6  shadow ">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5>mois : <?=$detail_mois['mois']?></h5>
                                                    <h5>AGENT : <?=$detail['nom']." ".$detail['postnom']." ". $detail['prenom']?></h5>
                                                    <h5>Matricule : <?=$detail['matricule']?></h5>
                                                    <h5>salaire mensuel : <?=$detail['salaire']?> $</h5>
                                                    <h5>argent servi  : <?=$montant_payer?> $</h5>
                                                    <h5>reste : <?=$reste=$detail['salaire']-$montant_payer?> $</h5>
                                                    
                                                    
                                                
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                
                                <?php }else{ ?>
                                 
                                <center><h3> montant  en caisse = <?=$_SESSION['caisse']?> $</h3></center> 
                                <a href=" remuneration.php?new" class="col-12 btn btn-outline-success">Remunerer</a> 
                                <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">


                                        <?php if(isset($_SESSION['notif'])){ ?>
                                            <center><p class="alert-<?=$_SESSION['color']?> alert">
                                            <b> <i class="bi bi-<?=$_SESSION['icon']?>">  <?php echo $_SESSION['notif']; unset($_SESSION['notif']) ?></i></b>
                                                    
                                            </p></center> 
                                        <?php } ?> 
                                    </div>
                            <?php } ?>
                <?php }  ?>
                            <div class=" table-responsive shadow p-3">
                                <table class="table table-borderless datatable   ">
                                <h4 class="p-3 ">Liste de remuneration</h4>
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>  
                                            <th scope="col">personnel</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">mois</th>
                                            <th scope="col">montant</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        $quantite=0;
                                        $numero=0;
                                        $totalg=0;
                                        while($data=$SelData->fetch())
                                        {
                                            $numero++;
                                        ?>
                                       <tr>
                                            <th scope="row"><?php echo $numero; ?></th>
                                            <td><?=$data['matricule']." : ".$data['nom']." ".$data['postnom']." ".$data['prenom']?></td>
                                            <td><?php $dates=strtotime($data["dates"]); echo date('d/m/Y',$dates);?></td>
                                            <td><?=$data['mmois']?></td>
                                            <td><?=$data['montant'] ?>$</td>
                                          
                                            <td>
                                            <a href="recu.php?com=<?=$data['id']?>" class="btn btn-success btn-sm "><i
                                             class="bi bi-eye-fill"></i></a>

                                              <a   href="?idsup=<?=$data['id']?>"
                                                class="btn btn-dark btn-sm "><i class="bi bi-trash3-fill"></i></a>
                                        </td>

                                       </tr>
                               
                                        <?php } ?>
                                       
                                    </tbody>
                                </table>
                                
                              </div>
                              <!-- End Table with stripped rows -->

                             </div>
                          </div>
                      </div>

                  </div>
              </div>
          </section>
    

     

        <footer id="footer">
        <?php 
          include_once('../include/footer.php');
          
          ?>
        </footer>

  </main><!-- End #main -->
  

  <!-- ======= Footer ======= -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- JS Files -->
  <?php 
    include_once('../include/script_tab.php');
    
    ?>

 


</body>

</html>