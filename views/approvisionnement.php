<?php 
include('../connexion/connexion.php');
include_once('../models/select/sel-approvisionnement.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>approvisionnement</title>
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
    
            <div class="col-120 bg-dark position-fixed m-auto p-3">
            
                <h2 class=" text-success">approvisionnement</h2>
              
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
                                    <a href="approvisionnement.php" class="btn btn-outline-danger text-white"><b><i class="bi bi-x"></i></b></a>
                                    
                                </div>
                                <div class="card-body py-3  text-white">
                                    Voulez-vous vraiment supprimer  l'approvisionnement"<b> <?=$supprimer['quantite']."L de quantite  et  de  ".$supprimer['montant']."$ du  "?> <?php $dates=strtotime($supprimer["dates"]); echo date('d/m/Y ',$dates);?> </b>"?
                                    <br>
                                    <em class="mt-3 text-danger">NB: cette action est irréversible</em>
                                </div>
                                <div class="card-footer">
                                    <a href='../models/del/del-approvisionnement.php?id=<?=$_GET['idsup'] ?>' class="btn btn-outline-danger">Supprimer</a>
                                    <a href="approvisionnement.php" class="btn btn-success">Annuler</a>
                                </div>

                            </div>
                        </div>
                    <?php
                }else { ?>
                     <?php if(isset($_GET['new'])){?>
                        <div class="shadow p-3 row">
                                    <center><h2>Choisir la commande</h2></center>
                            <?php while($commande=$SelCom->fetch()){?>
                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6  ">
                                    <a class=" btn btn-white shadow m-3 w-100" href="approvisionnement.php?com=<?=$commande['id']?>">
                                        <div class=row>
                                            <div class="col-12">
                                                <div class="row">
                                               
                                                    <div class="col-12">
                                                        Date : <?php $dates=strtotime($commande["dates"]); echo date('d/m/Y ',$dates);?>
                                                         <br>
                                                        <b>N° Commande: </b><?php echo sprintf('%04d', $commande['numcommande']);?>
                                                        <br>
                                                        <b>fournisseur : </b><?=$commande['nom'].' '.$commande['postnom'].' '.$commande['prenom']?>
                                                        <br>
                                                        <?php 
                                                        $com= $commande['id'];
                                                        $req=$connexion->prepare("SELECT * from panier_ap where commande=?");
                                                        $req->execute(array($com));
                                                        while($sPanier=$req->fetch()){ ?>
                                                        <?=$sPanier['type']." : ".$sPanier['quantite']?> m3<br>

                                                       <?php  }

                                                        ?>
                                                    </div>
                                                    
                                                    
                                            </div>
                                                                    
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php }?>
                        </div>
                     <?php }else if(isset($_GET['com'])){ ?>
                                <div>
                                  <form  class="shadow  p-3 m-3" action="<?=$action?>" id="uploadForm" method="POST" enctype="multipart/form-data">
                                  <h5 class="card-title text-center "><?=$titre?></h5>
                                    <div class="row">
                                        
                                         <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                            <label for=""><span>quantite essence</span><?=$_SESSION['quantite_essence']?></label>
                                            <input  required type="number"  max="<?=$_SESSION['quantite_essence']?>" step="0.01" class="form-control" placeholder="Ex:999.5"  name="quantite_essence" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['quantite']?>" <?php } ?>> 
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                            <label for="">quantite  mazout <?=$_SESSION['quantite_mazout']?></span></label>
                                            <input autocomplete="off" required type="number" max="<?=$_SESSION['quantite_mazout']?>" step="0.01" class="form-control" placeholder="Ex:999.5"  name="quantite_mazout" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['quantite']?>" <?php } ?>> 
                                        </div>
                                   
                                        
                                 
                                        <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                            <?php if(isset($_SESSION['notif'])){ ?>
                                                <center><p class="alert-<?=$_SESSION['color']?> alert">
                                                <b> <i class="bi bi-<?=$_SESSION['icon']?>">  <?php echo $_SESSION['notif']; unset($_SESSION['notif']) ?></i></b>
                                                        
                                                </p></center> 
                                            <?php } ?> 
                                         </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 ">
                                   
                                    <?php if(isset($_GET['id'])){?>
                                      <div class="row">
                                          <div class="col-xl-8 col-lg-8 col-md-8  col-sm-8">
                                            <input type="submit" class="btn btn-success text-white p-2 mt-1 w-100" name="valider" value="<?=$bouton?>">
                                          </div>
                                          <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4">
                                            <a href="approvisionnement.php" class="btn btn-dark p-2  mt-1 w-100">Annuler</a>
                                        </div>
                                      </div>
                                    <?php }else {?>
                                            <input type="submit" class="btn btn-success text-white p-2 w-100" name="valider" value="<?=$bouton?>">
                                        <?php } ?>
                                    </div>
                                          
                  
                
                                  </form>
                                </div>
                    <?php }else { ?>
                        <a href=" approvisionnement.php?new" class="col-12 btn btn-outline-success">nouvel approvisionnement</a> 
                        <?php } ?>
                <?php }  ?>

                            <div class="shadow p-3">
                                <table class="table datatable ">
                                <h4 class="p-3 ">Liste des approvisionnements</h4>
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">date</th>
                                            <th scope="col">N°commande</th>
                                            <th scope="col">fournisseur</th>
                                            <th scope="col">quantite_essence</th>  
                                            <th scope="col">quantite_essence</th>  
                                            <th scope="col">reste</th>  
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                     
                                        $id=0;
                                        while($data=$SelData->fetch())
                                        { 
                                            $id++;
                                        ?>
                                       <tr>
                                            <th scope="row"><?php echo $id; ?></th>
                                            <td><?php $dates=strtotime($data["dates"]); echo date('d/m/Y ',$dates);?> </td>
                                            <td><?php echo sprintf('%04d', $data['numcommande']);?></td>
                                            <td><?=$data['prenom']?> </td>
                                            <td><?=$data['quantite_essence']?> L</td>
                                            <td><?=$data['quantite_mazout']?> L</td>
                                            <td><?=$data['reste_argent']?> $</td>
                                            <td>
                                                <a href="approvisionnement.php?id=<?=$data['id']?>" class="btn btn-success btn-sm "><i
                                                        class="bi bi-pencil-square"></i></a>
                                                <a 
                                                    href="?idsup=<?=$data['id']?>"
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
          </section>
    

     

        <footer id="footer" class="bg-success">
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