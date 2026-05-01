<?php
include('../connexion/connexion.php');
include_once('../models/select/sel-client.php');

// Fonction utilitaire d'échappement
function e($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Gestion des Clients</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    
    <?php include_once('../include/link.php'); ?>
</head>

<body>
    <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>
    
    <?php include_once('../include/menu.php'); ?>

    <main id="main" class="main">
        <!-- Header -->
        <div class="row">
            <div class="col-12 bg-dark position-fixed m-auto p-3" style="z-index: 1000;">
                <h2 class="text-success">Gestion des Clients</h2>
            </div>
        </div>

        <section class="section" style="margin-top: 80px;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-3 m-3">
                        <div class="card-body">
                            
                            <?php if (isset($_GET['idsup']) && !empty($_GET['idsup'])): ?>
                                <!-- MODAL DE CONFIRMATION SUPPRESSION -->
                                <div class="col-12 h-100 d-flex justify-content-center align-items-center p-4">
                                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 bg-black card p-3 shadow m-3">
                                        <div class="card-header text-dark d-flex justify-content-between">
                                            <b class="text-white">Supprimer</b>
                                            <a href="client.php" class="btn btn-outline-danger text-white">
                                                <b><i class="bi bi-x"></i></b>
                                            </a>
                                        </div>
                                        <div class="card-body py-3 text-white">
                                            Voulez-vous vraiment supprimer "<b><?= e($supprimer['nom'] . " " . $supprimer['postnom'] . " " . $supprimer['prenom']) ?></b>"?
                                            <br>
                                            <em class="mt-3 text-danger">NB: cette action est irréversible</em>
                                        </div>
                                        <div class="card-footer">
                                            <a href="../models/del/del-client.php?id=<?= (int)$_GET['idsup'] ?>" class="btn btn-outline-danger">Supprimer</a>
                                            <a href="client.php" class="btn btn-success">Annuler</a>
                                        </div>
                                    </div>
                                </div>

                            <?php else: ?>
                                <!-- BOUTON AJOUTER -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="p-3">Gestion des Clients</h4>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                                        <i class="bi bi-plus-circle"></i> Ajouter Client
                                    </button>
                                </div>

                                <!-- MODAL FORMULAIRE AJOUT/ÉDITION -->
                                <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalFormLabel">
                                                    <?= isset($_GET['numero']) ? 'Modifier Client' : 'Nouveau Client' ?>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="shadow p-3" action="<?= isset($_GET['numero']) ? '../models/update/up-client.php' : '../models/add/add-client.php' ?>" 
                                                      id="uploadForm" method="POST" enctype="multipart/form-data">
                                                    
                                                    <div class="row">
                                                        <!-- NOM -->
                                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 p-3">
                                                            <label for="nom">Nom <span class="text-danger">*</span></label>
                                                            <input autocomplete="off" required type="text" class="form-control" 
                                                                   placeholder="Ex: KAMBALE" name="nom" id="nom"
                                                                   value="<?= isset($_GET['numero']) ? e($modData['nom']) : '' ?>">
                                                        </div>

                                                        <!-- POSTNOM -->
                                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 p-3">
                                                            <label for="postnom">Postnom <span class="text-danger">*</span></label>
                                                            <input autocomplete="off" required type="text" class="form-control" 
                                                                   placeholder="Ex: KILIMA" name="postnom" id="postnom"
                                                                   value="<?= isset($_GET['numero']) ? e($modData['postnom']) : '' ?>">
                                                        </div>

                                                        <!-- PRENOM -->
                                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 p-3">
                                                            <label for="prenom">Prénom <span class="text-danger">*</span></label>
                                                            <input autocomplete="off" required type="text" class="form-control" 
                                                                   placeholder="Ex: Julien" name="prenom" id="prenom"
                                                                   value="<?= isset($_GET['numero']) ? e($modData['prenom']) : '' ?>">
                                                        </div>

                                                        <!-- GENRE -->
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 p-3">
                                                            <label for="genre">Genre <span class="text-danger">*</span></label>
                                                            <select name="genre" id="genre" class="form-select" required>
                                                                <option value="F" <?= (isset($_GET['numero']) && $modData['genre'] == 'F') ? 'selected' : '' ?>>Féminin</option>
                                                                <option value="M" <?= (isset($_GET['numero']) && $modData['genre'] == 'M') ? 'selected' : '' ?>>Masculin</option>
                                                            </select>
                                                        </div>

                                                        <!-- TELEPHONE -->
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 p-3">
                                                            <label for="telephone">N° Téléphone <span class="text-danger">*</span></label>
                                                            <input autocomplete="off" required type="tel" class="form-control" 
                                                                   placeholder="ex: 0991147624" name="telephone" id="telephone"
                                                                   pattern="[0-9]{10}" 
                                                                   value="<?= isset($_GET['numero']) ? e($modData['telephone']) : '' ?>">
                                                        </div>

                                                        <!-- PHOTO -->
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 p-3">
                                                            <label for="photo">Photo <?= !isset($_GET['numero']) ? '<span class="text-danger">*</span>' : '' ?></label>
                                                            <input autocomplete="off" type="file" accept=".jpg,.jpeg,.png" 
                                                                   class="form-control" id="photo" name="photo" 
                                                                   <?= !isset($_GET['numero']) ? 'required' : '' ?>>

                                                            <div id="imagePreview" style="display: none; margin-top: 20px;">
                                                                <img id="previewImage" src="#" alt="Prévisualisation" style="max-width: 30%;">
                                                            </div>

                                                            <input type="hidden" id="croppedImage" name="croppedImage">
                                                        </div>

                                                        <!-- NOTIFICATIONS -->
                                                        <?php if (isset($_SESSION['notif'])): ?>
                                                            <div class="col-12 p-3 text-center">
                                                                <div class="alert alert-<?= e($_SESSION['color']) ?> alert-dismissible fade show">
                                                                    <i class="bi bi-<?= e($_SESSION['icon']) ?>"></i> <?= e($_SESSION['notif']) ?>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                                </div>
                                                                <?php unset($_SESSION['notif'], $_SESSION['color'], $_SESSION['icon']); ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <!-- BOUTONS -->
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                            <?php if (isset($_GET['numero'])): ?>
                                                                <input type="hidden" name="numero" value="<?= (int)$_GET['numero'] ?>">
                                                                <div class="row">
                                                                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                                                                        <button type="submit" class="btn btn-success text-white p-2 mt-1 w-100" name="valider">
                                                                            <i class="bi bi-check-circle"></i> Modifier
                                                                        </button>
                                                                    </div>
                                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                                        <a href="client.php" class="btn btn-dark p-2 mt-1 w-100">Annuler</a>
                                                                    </div>
                                                                </div>
                                                            <?php else: ?>
                                                                <button type="submit" class="btn btn-success text-white p-2 w-100" name="valider">
                                                                    <i class="bi bi-plus-circle"></i> Ajouter
                                                                </button>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div><!-- /row -->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TABLEAU DES CLIENTS -->
                                <div class="shadow p-3">
                                    <h4 class="p-3">Liste des clients</h4>
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Numéro</th>
                                                <th>Profil</th>
                                                <th>Noms</th>
                                                <th>Genre</th>
                                                <th>N° Téléphone</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $clients = $SelData->fetchAll();
                                            $numero = 0;
                                            foreach ($clients as $index => $data):
                                                $numero++;
                                                $modalId = 'modalSituation-' . $index;
                                            ?>
                                                <tr>
                                                    <th scope="row"><?= $numero ?></th>
                                                    <td><?= (int)$data['numero'] ?></td>
                                                    <td>
                                                        <a href="../assets/img/clients/<?= e($data['photo']) ?>" target="_blank">
                                                            <img src="../assets/img/clients/<?= e($data['photo']) ?>" alt="" width="40" class="rounded-circle">
                                                        </a>
                                                    </td>
                                                    <td><?= e($data['nom'] . " " . $data['postnom'] . " " . $data['prenom']) ?></td>
                                                    <td><?= $data['genre'] == 'M' ? 'Masculin' : 'Féminin' ?></td>
                                                    <td><?= e($data['telephone']) ?></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        <a href="client.php?numero=<?= (int)$data['numero'] ?>" class="btn btn-success btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="?idsup=<?= (int)$data['numero'] ?>" class="btn btn-dark btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                                                            <i class="bi bi-trash3-fill"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- MODALS SITUATION (un par client) -->
                                <?php foreach ($clients as $index => $data):
                                    $client_num = $data['numero'];
                                    $modalId = 'modalSituation-' . $index;

                                    // Requêtes pour la situation
                                    $SelCommande = $connexion->prepare("SELECT * FROM commande WHERE client = ? ORDER BY id DESC");
                                    $SelCommande->execute([$client_num]);

                                    $sel_payer = $connexion->prepare("
                                        SELECT SUM(pd.montant) as total 
                                        FROM paiment_dette pd
                                        JOIN commande c ON pd.commande = c.id 
                                        WHERE c.client = ?
                                    ");
                                    $sel_payer->execute([$client_num]);
                                    $total_payer = $sel_payer->fetch()['total'] ?? 0;

                                    $sel_dette = $connexion->prepare("
                                        SELECT SUM(p.prixunitaire * p.quantite) as total 
                                        FROM panier p
                                        JOIN commande c ON p.commande = c.id 
                                        WHERE c.supprimer = 0 AND c.type = 2 AND c.client = ?
                                    ");
                                    $sel_dette->execute([$client_num]);
                                    $total_dette = ($sel_dette->fetch()['total'] ?? 0) - $total_payer;

                                    $sel_non_livre = $connexion->prepare("
                                        SELECT SUM(nl.quantite_essence) as qte_essence,
                                               SUM(nl.quantite_mazout) as qte_mazout
                                        FROM nonlivrer nl
                                        JOIN commande c ON nl.commande = c.id
                                        WHERE c.client = ? AND nl.statut = 0 AND nl.supprimer = 0
                                    ");
                                    $sel_non_livre->execute([$client_num]);
                                    $non_livre = $sel_non_livre->fetch();
                                ?>
                                    <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success text-white">
                                                    <h5 class="modal-title">
                                                        <i class="bi bi-person-lines-fill"></i> 
                                                        Situation de <?= e($data['nom'] . " " . $data['postnom']) ?>
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Résumé -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="alert alert-success">
                                                                <h6><i class="bi bi-cash-stack"></i> Total Dette</h6>
                                                                <h4 class="mb-0"><?= number_format($total_dette, 2) ?> $</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="alert alert-warning">
                                                                <h6><i class="bi bi-truck"></i> Non Livré</h6>
                                                                <small>Essence: <?= (float)$non_livre['qte_essence'] ?> L</small><br>
                                                                <small>Mazout: <?= (float)$non_livre['qte_mazout'] ?> L</small>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Tableau commandes -->
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-striped table-hover">
                                                            <thead class="table-dark">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Date</th>
                                                                    <th>Facture N°</th>
                                                                    <th>Type</th>
                                                                    <th>Montant</th>
                                                                    <!-- <th>Action</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $num_cmd = 0;
                                                                $total_general = 0;

                                                                while ($cmd = $SelCommande->fetch()):
                                                                    $num_cmd++;
                                                                    $SelPanier = $connexion->prepare("SELECT quantite, prixunitaire FROM panier WHERE commande = ?");
                                                                    $SelPanier->execute([$cmd['id']]);
                                                                    $total_cmd = 0;
                                                                    while ($panier = $SelPanier->fetch()) {
                                                                        $total_cmd += $panier['quantite'] * $panier['prixunitaire'];
                                                                    }
                                                                    $total_general += $total_cmd;
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $num_cmd ?></td>
                                                                        <td><?= date('d/m/Y', strtotime($cmd['dates'])) ?></td>
                                                                        <td><?= sprintf('%04d', $cmd['numfacture']) ?></td>
                                                                        <td>
                                                                            <span class="badge bg-<?= $cmd['type'] == 1 ? 'success' : 'warning' ?>">
                                                                                <?= $cmd['type'] == 1 ? 'Cash' : 'Crédit' ?>
                                                                            </span>
                                                                        </td>
                                                                        <td><?= number_format($total_cmd, 2) ?> $</td>
                                                                        <!-- <td>
                                                                            <a href="facture.php?com=<?= (int)$cmd['id'] ?>" class="btn btn-success btn-sm">
                                                                                <i class="bi bi-eye-fill"></i>
                                                                            </a>
                                                                        </td> -->
                                                                    </tr>
                                                                <?php endwhile; ?>
                                                            </tbody>
                                                            <tfoot class="table-group-divider">
                                                                <tr class="table-primary">
                                                                    <td colspan="4"><strong>TOTAL GÉNÉRAL</strong></td>
                                                                    <td colspan="2"><strong><?= number_format($total_general, 2) ?> $</strong></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="bi bi-x-circle"></i> Fermer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer id="footer" class="bg-success">
            <?php include_once('../include/footer.php'); ?>
        </footer>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <?php include_once('../include/script_tab.php'); ?>
    
    <!-- Cropper.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

    <script>
        // Ouvrir modal si édition
        <?php if (isset($_GET['numero'])): ?>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('modalForm'));
                modal.show();
            });
        <?php endif; ?>

        // Cropper.js pour la photo
        let cropper = null;
        
        document.getElementById('photo')?.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImage = document.getElementById('previewImage');
                previewImage.src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';

                // Détruire l'ancien cropper s'il existe
                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(previewImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                    responsive: true,
                    guides: true,
                    center: true,
                    background: false,
                });
            };
            reader.readAsDataURL(file);
        });

        // Gestion soumission formulaire avec crop
        document.getElementById('uploadForm')?.addEventListener('submit', function(event) {
            if (cropper && document.getElementById('photo').files.length > 0) {
                event.preventDefault();
                
                const canvas = cropper.getCroppedCanvas({
                    width: 400,
                    height: 400,
                });

                document.getElementById('croppedImage').value = canvas.toDataURL('image/jpeg');
                this.submit();
            }
        });
    </script>
</body>
</html>