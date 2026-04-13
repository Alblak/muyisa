<?php
include_once('../connexion/connexion.php'); // fournit $connexion (PDO)

$start = isset($_GET['start']) && $_GET['start'] !== '' ? $_GET['start'] : null;
$end   = isset($_GET['end']) && $_GET['end'] !== '' ? $_GET['end'] : null;
$export = isset($_GET['export']) ? $_GET['export'] : null;

if (!isset($connexion) || !($connexion instanceof PDO)) {
    echo "Erreur : connexion à la base indisponible.";
    exit;
}

// Construire requête sur la vue mouvements_caisse_with_solde
$sql = "SELECT date_mouvement, source, description, entree, sortie, solde FROM mouvements_caisse_with_solde WHERE 1=1";
$params = [];
if ($start) {
    $sql .= " AND date_mouvement >= :start";
    $params['start'] = $start;
}
if ($end) {
    $sql .= " AND date_mouvement <= :end";
    $params['end'] = $end;
}
$sql .= " ORDER BY date_mouvement, source";

try {
    $stmt = $connexion->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    unset($stmt);
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Erreur SQL : " . htmlspecialchars($e->getMessage()) . "</div>";
    exit;
}

// Export CSV si demandé
if ($export === 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=livre_caisse.csv');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['Date','Source','Description','Entrée','Sortie','Solde']);
    foreach ($rows as $r) {
        fputcsv($out, [
            $r['date_mouvement'],
            $r['source'],
            $r['description'],
            number_format((float)$r['entree'],3,'.',''),
            number_format((float)$r['sortie'],3,'.',''),
            number_format((float)$r['solde'],3,'.','')
        ]);
    }
    fclose($out);
    exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Livre de caisse — Muyisa Énergie</title>
    <link href="../assets/ind/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print { .no-print{display:none!important;} }
        table td, table th { vertical-align: middle; }
    </style>
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
       
        <div class="no-print">
            <a href="livre_caisse_view.php" class="btn btn-sm btn-secondary">Réinitialiser</a>
            <button class="btn btn-sm btn-success" onclick="window.print()">Imprimer</button>
            <a href="?<?= ($start? 'start='.$start.'&':'') . ($end? 'end='.$end.'&':'') ?>export=csv" class="btn btn-sm btn-outline-primary">Export CSV</a>
        </div>
    </div>

    <form class="row g-2 no-print mb-3" method="get">
        <div class="col-auto">
            <input type="date" name="start" class="form-control form-control-sm" value="<?= htmlspecialchars($start ?? '') ?>">
        </div>
        <div class="col-auto">
            <input type="date" name="end" class="form-control form-control-sm" value="<?= htmlspecialchars($end ?? '') ?>">
        </div>
        <div class="col-auto">
            <button class="btn btn-sm btn-primary" type="submit">Filtrer</button>
        </div>
    </form>
     <div class="company-info">
          <h2>STATION MUYISA ENERGIE</h2>
          <div>
            <strong>RCCM:</strong> CD/Bbo/RCCM/23-A-1446<br>
            <strong>IMPÔT:</strong> A 20271017P<br>
            <strong>ID.NAT:</strong> 19-G4701-N50027E<br>
            <strong>Adresse:</strong> Q.VUTESTE, Cell. LUSANDO, N° 1<br>
            <strong>Tél:</strong> +243 993580599, +243 997287934
          </div>
        </div>

    <div class="table-responsive shadow-sm bg-white p-2">
          <center><h4 class="m-0">Livre de caisse</h4></center>
        <table class="table table-sm table-striped table-bordered mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Source</th>
                    <th>Description</th>
                    <th class="text-end">Entrée</th>
                    <th class="text-end">Sortie</th>
                    <th class="text-end">Solde</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($rows)): ?>
                <tr><td colspan="6" class="text-center">Aucun mouvement trouvé.</td></tr>
            <?php else: ?>
                <?php foreach ($rows as $r): ?>
                    <tr>
                        <td><?= htmlspecialchars(date('d/m/Y', strtotime($r['date_mouvement']))) ?></td>
                        <td><?= htmlspecialchars($r['source']) ?></td>
                        <td><?= nl2br(htmlspecialchars($r['description'])) ?></td>
                        <td class="text-end"><?= number_format((float)$r['entree'], 3) ?>$</td>
                        <td class="text-end"><?= number_format((float)$r['sortie'], 3) ?>$</td>
                        <td class="text-end fw-bold"><?= number_format((float)$r['solde'], 3) ?>$</td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="text-muted small mt-3">Généré le <?= date('d/m/Y H:i') ?></div>
</div>

<script src="../assets/ind/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
