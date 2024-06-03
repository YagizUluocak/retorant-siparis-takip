<?php
include("classes/abstractModel.php");
include("classes/payment.php");
include("includes/header.php");
include("includes/sidebar.php"); 

$payIdCol = 'payment_id';
$payment_id = $_GET['payment_id'];
$payment = new Payment();

$pay = $payment->getById($payment_id, $payIdCol);
$payget = $payment->getPaymentsByTable(); // Pass payment_id here
?>
<button type="button" class="btn btn-success m-3" onclick="filterPendingOrders()"><i class="fas fas fa-clock menu-icon"></i>Geçmiş Ödemeler</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $pay->payment_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ödeme Detayları</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="row">
          <?php 
          // Check if $payget is an array and has elements
          if (is_array($payget) && !empty($payget)) {
              foreach ($payget as $payment) {
                  echo $payment['table_num'] . " Numaralı masa<br>";
                  echo "Sipariş Numarası: " . $payment['order_id'] . "<br>";
                  echo "Ürün Adı: " . $payment['product_name'] . "<br>";
                  echo "Toplam Adet: " . $payment['total_quantity'] . "<br>";
                  echo "Toplam tutar: " . $payment['total_price'] . "<br>";
                  echo "Ödeme Durumu: " . $payment['payment_status'] . "<br>";
              }
          } else {
              echo "No payment details available.";
          }
          ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById('exampleModal<?php echo $pay->payment_id?>');
        var modalInstance = new bootstrap.Modal(modal, {
            backdrop: 'static' // Modal dışına tıklanarak kapatılması engelleniyor
        });
        modalInstance.show();
    });
</script>

<?php include("includes/footer.php")?>
