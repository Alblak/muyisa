<?php
// Exemple : page pour afficher le livre de caisse (solde courant calculé en PHP).
include_once('../connexion/connexion.php'); // doit fournir $connexion (PDO)

$start = isset($_GET['start']) ? $_GET['start'] : null;
$end   = isset($_GET['end'])   ? $_GET['end']   : null;

// Filtre de date (optionnel)
$dateWhere = "";
$params = [];
if ($start) {
    $dateWhere .= " AND date_mouvement >= :start";
    $params['start'] = $start;
}
if ($end) {
    $dateWhere .= " AND date_mouvement <= :end";
    $params['end'] = $end;
}

// Requête d'exemple : unionner plusieurs sources de mouvements.
// Adaptez les noms de colonnes / tables selon votre schéma.
$sql = "
SELECT date_field AS date_mouvement, CONCAT('Entree - ', COALESCE(libelle,'')) AS description, COALESCE(reste_argent,0) AS entree, 0 AS sortie, 'entree' AS source, id AS ref_id
FROM entree
WHERE supprimer=0

UNION ALL

SELECT commande.date AS date_mouvement, CONCAT('Vente #', commande.id) AS description, 
       COALESCE(SUM(p.prixunitaire*p.quantite),0) AS entree, 0 AS sortie, 'vente' AS source, commande.id AS ref_id
FROM commande
JOIN panier p ON p.commande=commande.id
WHERE commande.type=1 AND commande.supprimer=0
GROUP BY commande.id

UNION ALL

SELECT date AS date_mouvement, 'Paiement dette' AS description, COALESCE(montant,0) AS entree, 0 AS sortie, 'paiement_dette' AS source, id AS ref_id
FROM paiment_dette
WHERE supprimer=0

UNION ALL

SELECT dates AS date_mouvement, CONCAT('Remuneration - ', COALESCE(nom,'')) AS description, 0 AS entree, COALESCE(montant,0) AS sortie, 'remuneration' AS source, id AS ref_id
FROM remuneration
WHERE supprimer=0

UNION ALL

SELECT dates AS date_mouvement, CONCAT('Bon sortie - ', COALESCE(libelle,'')) AS description, 0 AS entree, COALESCE(montant,0) AS sortie, 'bondesortie' AS source, id AS ref_id
FROM bondesortie
WHERE supprimer=0

UNION ALL

SELECT commande_ap.date AS date_mouvement, CONCAT('Appro - #', commande_ap.id) AS description, 0 AS entree, COALESCE(SUM(pa.prixunitaire*pa.quantite),0) AS sortie, 'appro' AS source, commande_ap.id AS ref_id
FROM commande_ap
JOIN panier_ap pa ON pa.commande=commande_ap.id
WHERE commande_ap.supprimer=0
GROUP BY commande_ap.id

ORDER BY date_mouvement, source, ref_id
";

// Note : $sql ci-dessus est un exemple. Adaptez les champs date (date_field/dates/date) au schéma réel.

// Exécution via PDO
try {
    $stmt = $connexion->prepare($sql);
    // si filtres dates utilisés, il faudrait intégrer $dateWhere dans chaque sous-requête (non fait ici)
    $stmt->execute($params);
    $movements = $stmt->fetchAll(PDO::FETCH_ASSOC);
    unset($stmt);
} catch (Exception $e) {
    // en cas d'erreur, on affiche message et on arrête
    echo "<div class='alert alert-danger'>Erreur SQL : " . htmlspecialchars($e->getMessage()) . "</div>";
    $movements = [];
}

// Calcul du solde courant en PHP
$running = 0.0;
$rows = [];
foreach ($movements as $m) {
    $entree = floatval($m['entree']);
    $sortie = floatval($m['sortie']);
    $running += $entree - $sortie;
    $rows[] = [
        'date' => $m['date_mouvement'],
        'description' => $m['description'],
        'entree' => $entree,
        'sortie' => $sortie,
        'solde' => $running,
        'source' => $m['source'],
        'ref_id' => $m['ref_id'],
    ];
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Livre de caisse</title>
    <link href="../assets/ind/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print { .no-print{display:none!important;} }
        table td, table th { vertical-align: middle; }
    </style>
</head>
<body class="p-3 bg-light">
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Livre de caisse</h4>
        <div class="no-print">
            <button class="btn btn-sm btn-success" onclick="window.print()">Imprimer</button>
        </div>
    </div>

    <table class="table table-sm table-striped table-bordered">
        <thead class="table-light">
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th class="text-end">Entrée</th>
                <th class="text-end">Sortie</th>
                <th class="text-end">Solde</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r): ?>
                <tr>
                    <td><?= htmlspecialchars(date('d/m/Y', strtotime($r['date']))) ?></td>
                    <td><?= htmlspecialchars($r['description']) ?></td>
                    <td class="text-end"><?= number_format($r['entree'], 2) ?></td>
                    <td class="text-end"><?= number_format($r['sortie'], 2) ?></td>
                    <td class="text-end fw-bold"><?= number_format($r['solde'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="mt-3">
        <small class="text-muted">Généré le <?= date('d/m/Y H:i') ?></small>
    </div>
</div>
<script src="../assets/ind/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>