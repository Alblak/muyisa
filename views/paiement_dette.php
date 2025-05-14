<?php 
include('../connexion/connexion.php');
include_once('../models/select/sel-paiement_dette.php');
if(isset($_GET['personnel']))
{
   
    $mois=htmlspecialchars($_POST['mois']);
    header('location:paiement_dette.php?idpersonnel='.$_GET['personnel'].'&idmois='.$mois);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>paiement dette  </title>
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
            
                <h2 class=" text-white">paiement dette </h2>
              
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
                                    <a href="paiement_dette.php" class="btn btn-outline-danger text-white"><b><i class="bi bi-x"></i></b></a>
                                    
                                </div>
                                <div class="card-body py-3  text-white">
                                    Voulez-vous vraiment supprimer l'sortie de "<b> <?=$supprimer['nom']."  ".$supprimer['postnom']." d'une quantite de ".$supprimer['quantite']." L au prix de  ".$supprimer['prix']?> par L </b>"?
                                    <br>
                                    <em class="mt-3 text-danger">NB: cette action est irréversible</em>
                                </div>
                                <div class="card-footer">
                                    <a href='../models/del/del-paiement_dette.php?iddel=<?=$_GET['idsup'] ?>' class="btn btn-outline-danger">Supprimer</a>
                                    <a href="paiement_dette.php" class="btn btn-success">Annuler</a>
                                </div>
                            </div>
                        </div>
                    <?php
                }else { ?>
                            <?php if(isset($_GET['new']) && !isset($_GET['com'])){?>
                                <div class="shadow p-3 row">
                                    <center><h2>Choisir la dette du client</h2></center>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                                <label for=""></span></label>
                                                <a href="paiement_dette.php?fin"><input type="buttom" class="btn btn-success w-100" name="annuler " value="Annuler l'operation"></a>
                                        </div>
                                            
                                        <div class="col-xl-12 col-lg-12  p-3">
                                                <form class="search-form d-flex row "   method="get">
                                                            <input class="col-xl-10 col-lg-10 col-md-10  col-sm-10 p-3 m-1" required autocomplete="off" type="text" name="search" placeholder="Rechercher le client" title="">
                                                            <input hidden type="text" name="new">
                                                            <button class="col-xl-1 col-lg-1 col-md-1  col-sm-1 p-3 m-1 btn btn-dark" type="submit" title="Search"><i class="bi bi-search "></i></button>
                                                    <?php if(isset($_GET['search'])){ ?>
                                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
                                                        <a href="paiement_dette.php?new"><input  class="btn btn-success "type="button" value="Voir tout"></a>
                                                    </div>
                                                    <?php } ?>
                                                </form>
                                        </div>
                                        <?php
                                            $nb=0;
                                            while($commande=$sel_commande->fetch()){
                                                $nb++;
                                                $com=$commande['id'];
                                                $sel_payer=$connexion->prepare("SELECT sum(montant) as tot from paiment_dette where commande=?");
                                                $sel_payer->execute(array($com));
                                                $tot_payer=$sel_payer->fetch();
                                                if($tot_payer['tot']!="")
                                                {
                                                    
                                                    $total_payer=$tot_payer['tot'];
                                                }
                                                else
                                                {
                                                    $total_payer=0;
                                                }

                                                $reste=$commande['total']-$total_payer;
                                                
                                           
                                            ?>
                                        
                                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6   " <?php if($reste==0){?> hidden <?php } ?> >
                                                <a class=" btn btn-white shadow m-3 w-100 text-align-left" href="paiement_dette.php?idcom=<?=$commande['id']?>&reste=<?=$reste?>">
                                                    <div class=row>
                                                        
                                                        <div class="col-12">
                                                            <div class="row">
                                                               
                                                                <div class="col-12">
                                                                <b>Noms : </b><?=$commande['nom'].' '.$commande['postnom'].' '.$commande['prenom']?>
                                                                </div>
                                                                <div class="col-12">
                                                                <b>facture N° : </b><?php echo sprintf('%04d', $commande['numfacture'])?>
                                                                </div>
                                                                <div class="col-12">
                                                                <b>date  : </b> <?php $dates=strtotime($commande["dates"]); echo date('d/m/Y',$dates);?>
                                                                </div>
                                                                <div class="col-12">
                                                                <b>montant total: </b> <?=$commande['total'] ?>$
                                                                </div>
                                                                <div class="col-12">
                                                                <b>montant payer : </b> <?=$total_payer ?>$
                                                                </div>
                                                                <div class="col-12">
                                                                <b>montant reste : </b> <?=$reste ?>$
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
                        

                     
                            
                            <?php }else if(isset($_GET['idcom'])){ ?>
                            
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6">
                                            <form  class="shadow  p-3 m-3" action="../models/add/add-paiement_dette.php?idcom=<?=$_GET['idcom']?>" method="POST">
                                                <h5 class="card-title text-center "></h5>
                                                <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                                            <label for="">montant <?=$_GET['reste']?></span></label>
                                                            <input autocomplete="off" required type="number" step="0.01" max="<?=$_GET['reste']?>"  class="form-control" placeholder="Ex:150"  name="montant" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['montant']?>" <?php } ?>> 
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
                                                                    <a href="paiement_dette.php" class="btn btn-dark p-2  mt-1 w-100">Annuler</a>
                                                                </div>
                                                            
                                                    </div>
                                                </div>   
                            
                            
                                            </form>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6  shadow ">
                                            <div class="row">
                                                <div class="col-12">
                                                   
                                                    <h5>Client : <?=$detail['nom']." ".$detail['postnom']." ". $detail['prenom']?></h5>
                                                    <h5>facture n° :  <?php echo sprintf('%04d', $detail['numfacture'])?></h5>
                                                    <h5>total dette :  <?=$detail['total']?>$</h5>
                                                    <h5>montant payer  :  <?=$detail['total']-$_GET['reste']?>$</h5>
                                                    <h5>reste :  <?=$_GET['reste']?>$</h5>
                                                    
                                                
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                
                                <?php }else{ ?>
                                 
                                <center><h3> montant  en caisse = <?=$_SESSION['caisse']?> $</h3></center> 
                                <a href=" paiement_dette.php?new" class="col-12 btn btn-outline-success">Regler une dette </a> 
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
                                <h4 class="p-3 ">Liste de paiement</h4>
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>  
                                           
                                            <th scope="col">Date</th>
                                            <th scope="col">client</th>
                                           
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
                                            <td><?php $dates=strtotime($data["dates"]); echo date('d/m/Y',$dates);?></td>
                                            <td><?=$data['numero']." : ".$data['nom']." ".$data['postnom']." ".$data['prenom']?></td>
                                            
                                           
                                            <td><?=$data['montant'] ?>$</td>
                                          
                                            <td>
                                           

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