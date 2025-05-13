<?php 
include('../connexion/connexion.php');
include_once('../models/select/sel-bondesortie.php');
if(isset($_GET['personnel']))
{
   
    $mois=htmlspecialchars($_POST['mois']);
    header('location:bondesortie.php?idpersonnel='.$_GET['personnel'].'&idmois='.$mois);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>bon de sortie  </title>
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
            
                <h2 class=" text-white">bon de sortie </h2>
              
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
                                    <a href="bondesortie.php" class="btn btn-outline-danger text-white"><b><i class="bi bi-x"></i></b></a>
                                    
                                </div>
                                <div class="card-body py-3  text-white">
                                    Voulez-vous vraiment supprimer le bon de sortie pour "<b> <?=$supprimer['libelle']."  au  montant de  ".$supprimer['montant']?> $ </b>"?
                                    <br>
                                    <em class="mt-3 text-danger">NB: cette action est irréversible</em>
                                </div>
                                <div class="card-footer">
                                    <a href='../models/del/del-bondesortie.php?iddel=<?=$_GET['idsup'] ?>' class="btn btn-outline-danger">Supprimer</a>
                                    <a href="bondesortie.php" class="btn btn-success">Annuler</a>
                                </div>
                            </div>
                        </div>
                    <?php
                }else { ?>
                            <?php if(isset($_GET['new'])){ ?>
                            
                                <div class="row">
                                <center><h3> montant  en caisse = <?=$_SESSION['caisse']?> $</h3></center> 
                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
                                         <form  class="shadow  p-3 m-3" action="<?=$action?>" method="POST">
                                            <h5 class="card-title text-center "></h5>
                                            <div class="row">
                                                  <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                    <label for="">libelle</span></label>
                                                    <input autocomplete="off" required type="text" class="form-control" placeholder="Ex:frais de transport"  name="libelle" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['libelle']?>" <?php } ?>> 
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                    <label for="">montant en $ </span></label>
                                                    <input autocomplete="off" required type="number" max="<?=$_SESSION['caisse']?>" class="form-control" step="0.01"placeholder="Ex:300"  name="montant" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['montant']?>" <?php } ?>> 
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
                                                                <input type="submit" class="btn btn-success text-white p-2 mt-1 w-100" name="valider" value="<?=$bouton?>">
                                                            </div>
                                                            <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4">
                                                                <a href="bondesortie.php" class="btn btn-dark p-2  mt-1 w-100">Annuler</a>
                                                            </div>
                                                        
                                                </div>
                                            </div>   
                        
                        
                                        </form>
                                    </div>
                                  
                                   
                                   </div>
                            
                                   <?php } else{ ?>
                                 
                                <center><h3> montant  en caisse = <?=$_SESSION['caisse']?> $</h3></center> 
                                <a href="?new" class="col-12 btn btn-outline-success">emmetre un bon de sortie</a> 
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
                                <h4 class="p-3 ">Liste de bon de sortie</h4>
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>  
                                            
                                            <th scope="col">Date</th>
                                            <th scope="col">libelle</th>
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
                                            <td><?=$data['libelle']?></td>
                                            <td><?=$data['montant'] ?>$</td>
                                          
                                            <td> <a href="?new&id=<?=$data['id']?>" class="btn btn-dark btn-sm "><i
                                            class="bi bi-pencil-square"></i></a>
                                            <a href="bondesortie_view.php?bon=<?=$data['id']?>" class="btn btn-success btn-sm "><i
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