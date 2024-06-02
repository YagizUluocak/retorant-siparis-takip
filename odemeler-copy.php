<?php
include ("classes/abstractModel.php");
include("classes/payment.php");
include ("includes/header.php");
include ("includes/sidebar.php"); 

$payment = new Payment();

?>
<button type="button" class="btn btn-success m-3" onclick="filterPendingOrders()"><i class="fas fas fa-clock menu-icon"></i>Geçmiş Ödemeler</button>


            <table id="myTable" class="table table-striped mt-4 text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sipariş Numarası</th>
                        <th>Masa Adı</th>
                       <!-- <th>Ürün Adı</th> -->
                       <!-- <th>Adet</th> -->
                       <!-- <th>Toplam Tutar</th> -->
                        <th>Ödeme Durumu</th> 
                        <th>Detay</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($payment->getPaymentsByTable())
                        { 
                            foreach($payment->getPaymentsByTable() as $pay)
                            {
                                ?>
                                <tr>
                                    <td><?php echo $pay->payment_id?></td>
                                    <td><?php echo $pay->order_id?></td>
                                    <td><?php echo $pay->table_num . " Numaralı masa"?></td>
                                   <!-- <td><?php echo $pay->product_name?></td> -->
                                   <!-- <td><?php echo $pay->total_quantity?></td> -->
                                   <!-- <td><?php echo $pay->total_price?></td> -->
                                    <td><?php echo $pay->payment_status == 0 ? '<span style="color: green;">Ödenmedi</span>' : 'tamamlandı';?></td> 
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-eye"></i> Detay Gör
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>   
                </tbody>
            </table>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ödeme Detayları</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="row">
        <?php
        foreach($payment->getById($id, $idcolumn) as $pay)
        {
            ?>
                <div class="col-12">Masa Numarası: <?php echo $pay->table_num?></div>
                    
            <?php
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

const exampleModal = document.getElementById('exampleModal')
if (exampleModal) {
  exampleModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.

    // Update the modal's content.
    const modalTitle = exampleModal.querySelector('.modal-title')
    const modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalBodyInput.value = recipient
  })
}


const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})

$(document).ready(function() {
    $('#myTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "verileri_getir.php", // Verileri çekeceğiniz PHP dosyasının yolu
            "type": "POST"
        },
        "columns": [
            {"data": "id"},
            {"data": "isim"},
            {"data": "gorev"}
        ]
    });
});


</script>

<?php include ("includes/footer.php")?>