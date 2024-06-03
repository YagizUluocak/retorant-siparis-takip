<?php
include ("classes/abstractModel.php");
include("classes/payment.php");
include ("includes/header.php");
include ("includes/sidebar.php"); 

$payment = new Payment();
$filter = isset($_GET['filter']) && $_GET['filter'] == 'odenmemis' ? 'odenmemis' : Null;
$odenmis = isset($_GET['odenmis']) && $_GET['odenmis'] == 'odendi' ? 'odendi' : NULL;
$payments = $payment->getPayment($filter, $odenmis);
if(isset($_GET['islem']) && $_GET['islem'] === 'odemeYap' && isset($_GET['payment_id']))
{
    $payment = new Payment();
    $result = $payment->odemeYap();

    if($result)
    {
        echo "<script>window.location.href='odemeler.php?odenmis=odendi';</script>";
    }
    else
    {
        echo "Bir Hata Oluştu.";
    }
}
?>
<button type="button" class="btn btn-success m-3" onclick="filterodenmis()"><i class="fas fas fa-clock menu-icon"></i>Geçmiş Ödemeler</button>


            <table id="myTable" class="table table-striped mt-4 text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sipariş Numarası</th>
                        <th>Masa Adı</th>
                       <th>Ürün Adı</th>
                       <th>Adet</th>
                       <th>Toplam Tutar</th>
                        <th>Ödeme Durumu</th>  
                        <th>Ödeme Yap</th>                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($payments)
                        { 
                            foreach($payments as $payment)
                            {
                                ?>
                                <tr>
                                    <td><?php echo $payment->payment_id?></td>
                                    <td><?php echo $payment->order_id?></td>
                                    <td><?php echo $payment->table_num . " Numaralı masa"?></td>
                                   <td><?php echo $payment->product_name?></td>
                                   <td><?php echo $payment->total_quantity?></td>
                                   <td><?php echo $payment->total_price?></td>
                                   <td><?php echo $payment->payment_status?></td>
                                   
                                    
                                    <td><a name= "odemeYap" href="odemeler.php?payment_id=<?php echo $payment->payment_id?>&islem=odemeYap" class="btn btn-warning">Ödeme Yap</a></td>                               
                                </tr>
                                <?php
                            }
                        }
                    ?>   
                </tbody>
            </table>





<script>

function filterodenmis()
{
    window.location.href = window.location.pathname + "?odenmis=odendi";
}
function filterOdenmemis()
{
    window.location.href = window.location.pathname + "?filter=odenmemis";
}

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