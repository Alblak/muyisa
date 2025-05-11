<?php 
include('../connexion/connexion.php');
include('../models/select/sel-commande_ap.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Muyisa</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

 <?php include('../include/link.php'); ?> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<style>

@media print {
    .no-print {
        display: none;
    }
}

 @media print {
            .no-print {
                display: none;
            }
        }

 th, td ,tr {
      border: 5px solid black; 
      border-collapse: collapse; 
  }
 
</style>


</head>

<body class='m-3'>
<div class="row ">
    <div class="col-6 no-print mb-3">
        <a href="commande_ap.php?new" class="btn btn-primary col-12 me-2">fermer</a>
    </div>
    <!-- <div class="col-6 no-print mb-3">
        <button onclick="window.print()" class="btn btn-success col-12 me-2">Imprimer</button>
    </div> -->
    <div class="col-6 no-print mb-3">
        <button onclick="saveAsImage()" class="btn btn-dark col-12 me-2">Imprimer</button>
    </div>
</div>

<div class="m-3" id="invoice">
    <div class="row fw-bold">
        <div class="col-12">
                 <span class='fs-1'>STATION MUYISA ENERGIE</span>
        </div>
       
        <div class="col-12 fs-4">
              RCCM : CD/Bbo/RCCM/23-A-1446  <br>
              IMPOT: A 20271017P
              <br>
              ID.NAT: 19-G4701-N50027E
              <br>
                 Q.VUTESTE 
                 <br> Cell. LUSANDO ,   N° 1  
        </div>
        <div class="col-12 fs-3">
            <hr class='text-dark'>
            FOURNISSEUR : <?=$detail['nom']." ".$detail['postnom']?>
        </div>
        <div class="col-12">
           Bbo le <?php $dates=strtotime($detail["dates"]); echo date('d/m/Y ',$dates);?>   
        </div>
        <div class="col-12">
           <center>comamnde N°<?php echo sprintf('%04d', $detail['numcommande']);?>
        </div></center>
             
      </div>
  
    <table class="table">
        <thead>
        
                
            <tr>
                <th scope="col">Qte en m3</th>
                <th scope="col">Qte en litre</th>
                <th scope="col">Designation</th>
                
                <th scope="col"><center>P.U</center></th>
                <th scope="col"><center>P.T</center></th>
                
            </tr>
        </thead>
        <tbody>
            <?php 
            $numero=0;
            $total=0;
            while($data=$Selpanier->fetch()){
                $numero++;
                $PT=$data['prixunitaire']*$data['quantite'];
                $total=$total+$PT;
            ?>
            <tr>
                <td><strong><?=$data['quantite']?> m3</strong></td>
                <td><strong><?=$data['quantite']*1000?> L</strong></td>
            
                <td><strong><?=$data['type']?></strong></td>
                
                <td><strong><center><?=$data['prixunitaire']?></center></strong></td>
                <td><strong><center><?=$PT?></center></strong></td>
            
            </tr> 
            <?php } ?> 
            <tr>
            <td colspan='4' ><strong>TOTAL</strong> </td>
            <td><strong><center><?=$total?> $</center></strong> </td>
            </tr>  
            
            
        </tbody>
    </table>
    <div class="col-12 fs-4 ">
        le gerant
    </div>
  </div>
</div>

<script>
function saveAsImage() {
    const invoiceElement = document.getElementById('invoice');
    html2canvas(invoiceElement).then(canvas => {
        const link = document.createElement('a');
        link.download = 'commande.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
    });
}
</script>

</body>

</html>