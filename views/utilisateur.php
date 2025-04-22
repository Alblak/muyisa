<?php 
include('../connexion/connexion.php');
include_once('../models/select/sel-utilisateur.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Utilisateur</title>
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
            
                <h2 class=" text-success">Utilisateur</h2>
              
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
                                    <a href="utilisateur.php" class="btn btn-outline-danger text-white"><b><i class="bi bi-x"></i></b></a>
                                    
                                </div>
                                <div class="card-body py-3  text-white">
                                    Voulez-vous vraiment supprimer "<b> <?=$supprimer['nom']." ".$supprimer['postnom']." ".$supprimer['prenom']?> </b>"?
                                    <br>
                                    <em class="mt-3 text-danger">NB: cette action est irréversible</em>
                                </div>
                                <div class="card-footer">
                                    <a href='../models/del/del-utilisateur.php?id=<?=$_GET['idsup'] ?>' class="btn btn-outline-danger">Supprimer</a>
                                    <a href="utilisateur.php" class="btn btn-success">Annuler</a>
                                </div>

                            </div>
                        </div>
                    <?php
                }else { ?>
                                <div>
                                  <form  class="shadow  p-3 m-3" action="<?=$action?>" method="POST" enctype="multipart/form-data">
                                  <h5 class="card-title text-center "><?=$titre?></h5>
                                    <div class="row">
                                        
                                         <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4 p-3">
                                            <label for="">Nom</span></label>
                                            <input autocomplete="off" required type="text" class="form-control" placeholder="Ex:KAMBALE"  name="nom" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['nom']?>" <?php } ?>> 
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4 p-3">
                                            <label for="">Postnom</span></label>
                                            <input autocomplete="off" required type="text" class="form-control" placeholder="Ex:KAMALA"  name="postnom" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['postnom']?>" <?php } ?>> 
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4 p-3">
                                            <label for="">Prenom</span></label>
                                            <input autocomplete="off" required type="text" class="form-control" placeholder="Ex:Albert"  name="prenom" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['prenom']?>" <?php } ?>> 
                                        </div>
                                 
                                        
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                            <label for="">fonction</span></label>
                                            <select name="fonction" id="fonction" class="form-select">
                                                <?php if(isset($_GET['id'])){ ?>
                                                    <option value="Gerant">Caissiere</option>
                                                    <option <?php if($modData['fonction']=="comptable"){ ?> Selected <?php } ?> value="comptable">Comptable</option>
                                                    <option <?php if($modData['fonction']=="gerant"){ ?> Selected <?php } ?> value="gerant">gerant</option>
                                                    <option <?php if($modData['fonction']=="pdg"){ ?> Selected <?php } ?> value="pdg">PDG</option>
                                                <?php }else{?>
                                                    <option value="Gerant">Caissiere</option>
                                                    <option value="comptable">Comptable</option>
                                                    <option  value="gerant">gerant</option>
                                                    <option  value="pdg">PDG</option>
                                                <?php }  ?>
                                            </select>
                                            
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                            <label for="">Mot de passe</span></label>
                                            <input autocomplete="off" required type="text" class="form-control" placeholder=""  name="motdepasse" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['password']?>" <?php } ?>> 
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 p-3">
                                                <label for="">Photo</span></label>
                                            <input autocomplete="off" required type="file" class="form-control" id="photo" name="photo" <?php if(isset($id)) { ?> value="<?= $ModData['photo'] ?>" <?php } ?>>
                                            <!-- Zone de prévisualisation et de recadrage -->
                                            <div id="imagePreview" style="display: none; margin-top: 20px;">
                                                <img id="previewImage" src="#" alt="Prévisualisation de l'image" style="max-width: 50%;">
                                            </div>
                                            <!-- Champ caché pour l'image recadrée -->
                                            <input type="hidden" id="croppedImage" name="croppedImage">
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
                                            <a href="utilisateur.php" class="btn btn-dark p-2  mt-1 w-100">Annuler</a>
                                        </div>
                                      </div>
                                    <?php }else {?>
                                            <input type="submit" class="btn btn-success text-white p-2 w-100" name="valider" value="<?=$bouton?>">
                                        <?php } ?>
                                    </div>
                                          
                  
                
                                  </form>
                                </div>
                  <?php }  ?>

                            <div class="shadow p-3">
                                <table class="table datatable ">
                                <h4 class="p-3 ">Liste des utilisateurs</h4>
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>
                                            <th scope="col">Profil</th>  
                                            <th scope="col">Noms</th>
                                            
                                            <th scope="col"> Username</th>
                                            <th scope="col"> mot de passe</th>
                                            <th scope="col">fonction</th>
                                            <th scope="col">Action</th>

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
                                       
                                            <td><?=$data['nom']." ".$data['postnom']." ".$data['prenom'] ?></td>
                                            <th scope="row"><a href="../assets/img/produit/<?= $data['photo'] ?>"><img src="../assets/img/produit/<?= $data['photo'] ?>" alt="" width=40></a></th>
                                            <td><?=$data['username'] ?></td>
                                            <td><?=$data['password']?></td>
                                            <td><?=$data['fonction']?></td>
                                            <td>
                                                <a href="utilisateur.php?id=<?=$data['id']?>" class="btn btn-success btn-sm "><i
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

 

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script src="cropper.min.js"></script>
  <script>
    document.getElementById('photo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Afficher l'image dans la zone de prévisualisation
                const previewImage = document.getElementById('previewImage');
                previewImage.src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';

                // Initialiser Cropper.js
                const cropper = new Cropper(previewImage, {
                    aspectRatio: 1, // Ratio 1:1 pour une image carrée
                    viewMode: 1, // Mode de vue (1 pour limiter le recadrage à la zone de l'image)
                    autoCropArea: 1, // Zone de recadrage automatique (1 pour toute l'image)
                    responsive: true, // Redimensionnement réactif
                    guides: true, // Afficher les guides de recadrage
                    center: true, // Centrer les guides
                    background: false, // Désactiver le fond
                });

                // Gérer l'envoi du formulaire
                document.getElementById('uploadForm').addEventListener('submit', function(event) {
                    event.preventDefault(); // Empêcher l'envoi du formulaire par défaut

                    // Récupérer l'image recadrée
                    const canvas = cropper.getCroppedCanvas({
                        width: 400, // Largeur de l'image recadrée
                        height: 400, // Hauteur de l'image recadrée
                    });

                    // Convertir l'image recadrée en base64
                    const croppedImage = canvas.toDataURL('image/jpeg');

                    // Ajouter l'image recadrée au formulaire
                    document.getElementById('croppedImage').value = croppedImage;

                    // Envoyer le formulaire
                    this.submit();
                });
            };
            reader.readAsDataURL(file);
        }
    });
  </script> -->
</body>

</html>