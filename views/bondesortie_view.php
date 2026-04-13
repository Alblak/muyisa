<?php
// Affiche le détail d'un bon de sortie et propose impression

// Exemple sans base de données : données fictives
$id = isset($_GET['bon']) ? intval($_GET['bon']) : 1;

// jeu de données fictif (exemples)
$examples = [
    1 => [
        'id' => 1,
        'dates' => '2025-01-15',
        'libelle' => 'Frais de transport - livraison A',
        'montant' => '350.50',
        'user' => 'Albert',
        'note' => 'Paiement urgent',
        'details' => "Camion X, trajet A->B\nNombre de palettes : 12",
        'montant_lettres' => 'trois cent cinquante dollars cinquante cents'
    ],
    2 => [
        'id' => 2,
        'dates' => '2025-01-16',
        'libelle' => 'Achat fournitures',
        'montant' => '120.00',
        'user' => 'Comptable',
        'note' => '',
        'details' => "Fournitures bureau, facture #F123",
        'montant_lettres' => 'cent vingt dollars'
    ],
    3 => [
        'id' => 3,
        'dates' => '2025-01-17',
        'libelle' => 'Remboursement frais',
        'montant' => '75.00',
        'user' => 'Caissière',
        'note' => 'Remise reçue',
        'details' => "Taxi pour mission X",
        'montant_lettres' => 'soixante-quinze dollars'
    ],
];

// Choisit l'exemple correspondant ou le premier si absent
$bon = $examples[$id] ?? reset($examples);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Détail Bon de sortie #<?= htmlspecialchars($bon['id']) ?></title>
    <link href="../assets/ind/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Masquer les contrôles à l'impression */
        @media print {
            .no-print { display: none !important; }
            body { background: #fff; }
        }
        .doc-box {
            border: 1px solid #ddd;
            padding: 24px;
            border-radius: 6px;
            background: #fff;
        }
        .brand {
            color: #2d6a4f;
            font-weight: 700;
        }
    </style>
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="brand">MUYISA ÉNERGIE</h4>
            <small class="text-muted">Bon de sortie</small>
        </div>
        <div class="no-print">
            <a href="bondesortie.php" class="btn btn-secondary btn-sm">Retour</a>
            <button onclick="window.print()" class="btn btn-success btn-sm">Imprimer</button>
        </div>
    </div>

    <?php if (!$bon) : ?>
        <div class="alert alert-warning">Bon de sortie introuvable pour l'identifiant <?= htmlspecialchars($id) ?>.</div>
    <?php else :
        $dateStr = isset($bon['dates']) ? date('d/m/Y', strtotime($bon['dates'])) : '';
    ?>
    <div class="doc-box shadow-sm">
        <div class="row mb-3">
            <div class="col-6">
                <h5>Bon n°: <strong><?= htmlspecialchars($bon['id']) ?></strong></h5>
                <p class="mb-0"><strong>Date :</strong> <?= htmlspecialchars($dateStr) ?></p>
                <?php if (!empty($bon['libelle'])): ?>
                    <p class="mb-0"><strong>Libellé :</strong> <?= htmlspecialchars($bon['libelle']) ?></p>
                <?php endif; ?>
                <?php if (!empty($bon['montant'])): ?>
                    <p class="mb-0"><strong>Montant :</strong> <?= htmlspecialchars($bon['montant']) ?> $</p>
                <?php endif; ?>
            </div>
            <div class="col-6 text-end">
                <p class="mb-0"><strong>Émis par :</strong> <?= htmlspecialchars($bon['user']) ?></p>
                <?php if (!empty($bon['note'])): ?>
                    <p class="mb-0"><strong>Note :</strong> <?= htmlspecialchars($bon['note']) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <hr>

        <?php if (!empty($bon['details'])): ?>
            <div class="mb-3">
                <h6>Détails</h6>
                <p><?= nl2br(htmlspecialchars($bon['details'])) ?></p>
            </div>
        <?php endif; ?>

        <div class="row mt-4">
            <div class="col-6">
                <p class="mb-0"><strong>Montant en lettres :</strong></p>
                <p class="fw-bold"><?= htmlspecialchars($bon['montant_lettres']) ?></p>
            </div>
            <div class="col-6 text-end">
                <p class="mb-0">Signature :</p>
                <div style="height:60px;border-bottom:1px solid #000;width:200px;margin-left:auto;"></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="text-center text-muted small mt-3">
        Généré le <?= date('d/m/Y H:i') ?>
    </div>
</div>

<script src="../assets/ind/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>