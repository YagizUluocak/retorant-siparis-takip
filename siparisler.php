<?php
include ("classes/abstractModel.php");
include("classes/order.php");
include ("includes/header.php");
include ("includes/sidebar.php"); 

$order = new Order();

$filter = isset($_GET['filter']) && $_GET['filter'] == 'pending' ? 'pending' : null; // Bekleyen Siparişleri filtrelemek için get methodu ile kontrol sağladık
$completed = isset($_GET['completed']) && $_GET['completed'] == 'tamamlandı' ? 'tamamlandı' : null; // Tamamlanan Siparişleri filtrelemek için get methodu ile kontrol sağladık
$orders = $order->getOrder($filter, $completed); //Tüm Siparişleri Listeler
$isteslim = isset($_GET['completed']) && $_GET['completed'] === 'tamamlandı'; //Teslim Et Butonunu Tamamlanan siparişler filtresinde Teslim Et butonunu Gizlemek için sorgu oluşturuk.

// Teslim Et Butonuna basılıp basılmadığını kontrol etmek için kullanılır
if(isset($_GET['islem']) && $_GET['islem'] === 'teslimEt' && isset($_GET['order_id']))
{
    $order = new Order;
    $result = $order->siparisTeslim();

    if($result){
        echo "<script>window.location.href='siparisler.php?filter=pending';</script>";
    }else{
        echo "Bir Hata Oluştu.";
    }
}

?>



<!-- Tamamlanmış Siparişleri Filtrele -->
<button type="button" class="btn btn-warning m-3" style="float: right;" onclick="filterCompletedOrders()">
<i class="fas fa-clock menu-icon"></i> Tamamlanan Siparişler
</button>


<table id="myTable" class="table table-striped mt-4 text-center">

   <thead>
      <tr>
         <th style="width:50px;">ID</th>
         <th>Masa Numarası</th>
         <th>Ürün Adı</th>
         <th>Adet</th>
         <th>Sipariş Durumu</th>
         <th style="width:150px;">Teslim Et</th>
      </tr>
   </thead>

    <tbody>
      <?php
         if($orders)
         { 
            foreach($orders as $order)
            {
      ?>
            <tr>
               <td><?php echo $order->order_id ?></td>
               <td><?php echo $order->table_num . " Numaralı masa"?></td>
               <td><?php echo $order->product_name?></td>
               <td><?php echo $order->amount?></td>
               <td><?php echo $order->order_status == 0 ? '<span style="color: green;">Pending</span>' : 'tamamlandı'; ?></td>
      <?php
               if(!$isteslim)
               { // Teslim Edilen siparişler Sayfasında Teslim Et Butonunu Gizlemek İçin kullandık.
                  ?>
                  <td>
                     <a class="btn btn-danger" name="teslim"  href="siparisler.php?order_id=<?php echo $order->order_id?>&islem=teslimEt">
                        <i class="fa-solid fa-bell-concierge"></i> Teslim Et
                     </a>
                  </td>
                  <?php
               }
                  ?>
                  <td>
                     <a class="btn btn-warning" name="teslim" href="#"><i class="fa-solid fa-eye"></i> Detay Gör</a>
                  </td>
            </tr>

               <?php
            }
         }
        ?>   
    </tbody>

</table>



<script>

    function filterPendingOrders() {
        window.location.href = window.location.pathname + "?filter=pending";
    }

    function filterCompletedOrders(){
        window.location.href = window.location.pathname + "?completed=tamamlandı";
    }



    $(document).ready(function() {
        $('#myTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "verileri_getir.php",
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