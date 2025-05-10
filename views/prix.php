<?php 
include('../connexion/connexion.php');
include_once('../models/select/sel-prix.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>prix</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <style>




 
</style>
  
    <?php 
    include_once('../include/link.php');
    
    ?>
  
  
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
            
                <h2 class=" text-success">prix</h2>
              
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
                                    <a href="prix.php" class="btn btn-outline-danger text-white"><b><i class="bi bi-x"></i></b></a>
                                    
                                </div>
                                <div class="card-body py-3  text-white">
                                    Voulez-vous vraiment supprimer "<b> <?=$supprimer['equivalent']?>"
                                    <br>
                                    <em class="mt-3 text-danger">NB: cette action est irréversible</em>
                                </div>
                                <div class="card-footer">
                                    <a href='../models/del/del-prix.php?id=<?=$_GET['idsup'] ?>' class="btn btn-outline-danger">Supprimer</a>
                                    <a href="prix.php" class="btn btn-success">Annuler</a>
                                </div>

                            </div>
                        </div>
                    <?php
                }else { ?>
                                <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                    <?php if(isset($_SESSION['notif'])){ ?>
                                        <center><p class="alert-<?=$_SESSION['color']?> alert">
                                        <b> <i class="bi bi-<?=$_SESSION['icon']?>">  <?php echo $_SESSION['notif']; unset($_SESSION['notif']) ?></i></b>
                                                
                                        </p></center> 
                                    <?php } ?> 
                                </div>
                                <?php if($compt>0 && !isset($_GET['id'])){?>
                                    <div class='shadow p-3'>
                                        <div class="row">
                                             <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4 p-3">
                                                <a href='prix.php?id=<?=$last['id']?>' class="btn btn-outline-success col-12">Mettre a  jour le prix </a>
                                            </div>
                                            <div class="col-xl-8 col-lg-8 col-md-8  col-sm-8 p-3">
                                                <center><h2>PRIX DU JOUR</h2></center>
                                                <!-- <center><h2>1 L essence = <?=$last['prix_essenceL']?> $</h2></center>
                                                <center><h2>1 L mazout = <?=$last['prix_mazoutL']?> $</h2></center> -->
                                                <center>
                                                    <table border='1'>
                                                        <thead>
                                                            <th>Essence</th>
                                                           
                                                            <th>Mazout</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr >
                                                                <td>1L = <?=$last['prix_essenceL']?>$</td>
                                                                
                                                                <td>.   1L= <?=$last['prix_mazoutL']?>$</td>
                                                            </tr>
                                                            <tr>
                                                                <td>1 fut = <?=$last['prix_essenceF']?>$</td>
                                                                
                                                                <td>.    1 fut= <?=$last['prix_mazoutF']?>$</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </center>
                                            </div>
                                        
                                        </div>
                                          
                                     </div>
                                <?php }else {?>
                                    <div>
                                    <form  class="shadow  p-3 m-3" action="<?=$action?>" method="POST" enctype="multipart/form-data">
                                    <h5 class="card-title text-center "><?=$titre?></h5>
                                        <div class="row">
                                            
                                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                <label for="">Prix essence en $ par litre </span></label>
                                                <input autocomplete="off" required type="number" class="form-control" step="0.01" placeholder="ex: 2800"  name="prix_essenceL" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['prix_essenceL']?>" <?php } ?>> 
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                <label for="">Prix mazout en $ par litre</span></label>
                                                <input autocomplete="off" required type="number" class="form-control" step="0.01" placeholder="ex: 2800"  name="prix_mazoutL" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['prix_mazoutL']?>" <?php } ?>> 
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                <label for="">Prix essence en $ par fut </span></label>
                                                <input autocomplete="off" required type="number" class="form-control" step="0.01" placeholder="ex: 280000"  name="prix_essenceF" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['prix_essenceF']?>" <?php } ?>> 
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                <label for="">Prix mazout en $ par fut</span></label>
                                                <input autocomplete="off" required type="number" class="form-control" step="0.01" placeholder="ex: 2800"  name="prix_mazoutF" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['prix_mazoutF']?>" <?php } ?>> 
                                            </div>
                                            
                                        <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">


                                           
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 ">
                                    
                                        <?php if(isset($_GET['id'])){?>
                                        <div class="row">
                                            <div class="col-xl-8 col-lg-8 col-md-8  col-sm-8">
                                                <input type="submit" class="btn btn-success text-white p-2 mt-1 w-100" name="valider" value="<?=$bouton?>">
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4">
                                                <a href="prix.php" class="btn btn-dark p-2  mt-1 w-100">Annuler</a>
                                            </div>
                                        </div>
                                        <?php }else {?>
                                                <input type="submit" class="btn btn-success text-white p-2 w-100" name="valider" value="<?=$bouton?>">
                                            <?php } ?>
                                        </div>
                                            
                    
                    
                                    </form>
                                    </div>
                                <?php } ?>


                                
                  <?php }  ?>

                            <div class="shadow p-3">
                                <table class="table datatable ">
                                <h4 class="p-3 ">Historique du prix</h4>
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>
                                            <th scope="col">date</th>
                                            <th scope="col">prix essence  litre</th>
                                            
                                            <th scope="col">prix essence fut </th>
                                            <th scope="col">prix mazout litre </th>
                                            <th scope="col">prix mazout fut  </th>
                                            

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                     
                                        $numero=0;
                                        while($data=$SelData->fetch())
                                        { 
                                            $numero++;
                                        ?>
                                       <tr>
                                            <th scope="row"><?php echo $numero; ?></th>
                                            <td><?php $dates=strtotime($data["dates"]); echo date('d/m/Y ',$dates);?> </td>
                                            <td><?=$data['prix_essenceL']?> $</td>
                                            <td><?=$data['prix_essenceF']?> $</td>
                                            <td><?=$data['prix_mazoutL']?> $</td>
                                            <td><?=$data['prix_mazoutF']?> $</td>
                                           

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