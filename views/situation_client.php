<?php
include('../connexion/connexion.php');
include_once('../models/select/sel-situation_client.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title class="no-print">Situation Client</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }

        .client-card {
            transition: transform 0.2s;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .client-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        .modal-content {
            border-radius: 10px;
        }
    </style>

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
    <i class="bi bi-list mobile-nav-toggle d-xl-none no-print"></i>

    <main id="main" class="main">
        <div class="row">
            <div class="col-12 bg-black position-fixed m-auto p-3 no-print">
                <h2 class="text-white">Situation Clients</h2>
            </div>
        </div>

        <section class="section mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-3 m-3">
                        <div class="card-body">
                            <!-- Search Form -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <form class="search-form d-flex" method="get">
                                        <input class="form-control me-2" required autocomplete="off" type="text" name="search" placeholder="Rechercher un client..." title="">
                                        <button class="btn btn-dark" type="submit" title="Search"><i class="bi bi-search"></i></button>
                                        <?php if (isset($_GET['search'])) { ?>
                                            <a href="situation_client.php" class="btn btn-success ms-2">Voir tout</a>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>

                            <!-- Clients Cards -->
                            <div class="row">
                                <?php
                                $nb = 0;
                                while ($Client = $SelClient->fetch()) {
                                    $nb++;
                                    // Calculate data for modal
                                    $client_num = $Client['numero'];
                                    $SelData = $connexion->prepare("SELECT * from commande where commande.client=? ORDER BY commande.id DESC");
                                    $SelData->execute(array($client_num));

                                    $sel_payer = $connexion->prepare("SELECT sum(paiment_dette.montant) as total from paiment_dette,client,commande where paiment_dette.commande=commande.id and commande.client=client.numero and commande.client=?");
                                    $sel_payer->execute(array($client_num));
                                    $payer = $sel_payer->fetch();
                                    $total_payer = $payer['total'] ?? 0;

                                    $sel_dette = $connexion->prepare("SELECT sum(panier.prixunitaire*panier.quantite) as total from panier,commande where panier.commande=commande.id and commande.supprimer=0 and commande.type=2 and commande.client=?");
                                    $sel_dette->execute(array($client_num));
                                    $dette = $sel_dette->fetch();
                                    $total_dette = $dette['total'] ?? 0;
                                    $total_dette_gen = $total_dette - $total_payer;

                                    $SelDetail = $connexion->prepare("SELECT * from client where numero=?");
                                    $SelDetail->execute(array($client_num));
                                    $detail = $SelDetail->fetch();

                                    $sel_non_liver = $connexion->prepare("SELECT sum(nonlivrer.quantite_essence) as quantite_essence,sum(nonlivrer.quantite_mazout) as quantite_mazout from nonlivrer,commande where commande.id=nonlivrer.commande and commande.client=? and nonlivrer.statut=0 and nonlivrer.supprimer=0");
                                    $sel_non_liver->execute(array($client_num));
                                    $non_liver = $sel_non_liver->fetch();
                                    $quantite_essenceNL = $non_liver['quantite_essence'] ?? 0;
                                    $quantite_mazoutNL = $non_liver['quantite_mazout'] ?? 0;
                                ?>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4">
                                        <div class="card client-card h-100">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title"><?php echo $Client['nom'] . ' ' . $Client['postnom'] . ' ' . $Client['prenom']; ?></h5>
                                                <p class="card-text">
                                                    <strong>Numéro Client:</strong> <?php echo $Client['numero']; ?><br>
                                                    <strong>Téléphone:</strong> <?php echo $Client['telephone']; ?>
                                                </p>
                                                <button class="btn btn-success mt-auto" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $client_num; ?>">Voir Situation</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-<?php echo $client_num; ?>" tabindex="-1" aria-labelledby="modalLabel-<?php echo $client_num; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel-<?php echo $client_num; ?>">Situation de <?php echo $detail['nom'] . " " . $detail['postnom'] . " " . $detail['prenom']; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-3">
                                                        <div class="col-6">
                                                            <div class="alert alert-info">
                                                                <strong>Total Dette:</strong> <?php echo $total_dette_gen; ?> $
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="alert alert-warning">
                                                                <strong>Essence Non Livrée:</strong> <?php echo $quantite_essenceNL; ?> L<br>
                                                                <strong>Mazout Non Livré:</strong> <?php echo $quantite_mazoutNL; ?> L
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>N°</th>
                                                                    <th>Date</th>
                                                                    <th>Facture N°</th>
                                                                    <th>Type Achat</th>
                                                                    <th>Montant</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $numero = 0;
                                                                $totalg = 0;
                                                                $SelData->execute(array($client_num)); // Re-execute for modal
                                                                while ($data = $SelData->fetch()) {
                                                                    $total = 0;
                                                                    $com = $data['id'];
                                                                    $Selpanier = $connexion->prepare("SELECT * from panier where commande=?");
                                                                    $Selpanier->execute(array($com));
                                                                    $tot = 0;
                                                                    while ($panier = $Selpanier->fetch()) {
                                                                        $tot = $panier['quantite'] * $panier['prixunitaire'];
                                                                        $total += $tot;
                                                                    }
                                                                    $totalg += $total;
                                                                    $numero++;
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $numero; ?></td>
                                                                        <td><?php echo date('d/m/Y', strtotime($data["dates"])); ?></td>
                                                                        <td><?php echo sprintf('%04d', $data['numfacture']); ?></td>
                                                                        <td><?php echo $data['type'] == 1 ? "cash" : "credit"; ?></td>
                                                                        <td><?php echo $total; ?>$</td>
                                                                        <td>
                                                                            <a href="facture.php?com=<?php echo $data['id']; ?>" class="btn btn-success btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td colspan="4"><strong>TOTAL</strong></td>
                                                                    <td><strong><?php echo $totalg; ?> $</strong></td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <?php if ($nb == 0) { ?>
                                <center><?php echo $message; ?></center>
                            <?php } ?>

                            <!-- Notifications -->
                            <?php if (isset($_SESSION['notif'])) { ?>
                                <div class="alert alert-<?php echo $_SESSION['color']; ?> mt-3">
                                    <i class="bi bi-<?php echo $_SESSION['icon']; ?>"></i> <?php echo $_SESSION['notif']; unset($_SESSION['notif']); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer id="footer" class="no-print">
            <?php
            include_once('../include/footer.php');
            ?>
        </footer>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- JS Files -->
    <?php
    include_once('../include/script_tab.php');
    ?>

</body>

</html>
