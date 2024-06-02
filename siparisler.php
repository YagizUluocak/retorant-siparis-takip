<?php
include ("classes/abstractModel.php");
include("classes/order.php");
include ("includes/header.php");
include ("includes/sidebar.php"); 

$order = new Order();

$filter = isset($_GET['filter']) && $_GET['filter'] == 'pending' ? 'pending' : null;
$completed = isset($_GET['completed']) && $_GET['completed'] == 'tamamlandı' ? 'tamamlandı' : null;
$orders = $order->getOrder($filter, $completed);
?>

<button type="button" class="btn btn-success m-3" onclick="filterPendingOrders()"><i class="fas fas fa-clock menu-icon"></i>Bekleyen Siparişler</button>


<button type="button" class="btn btn-warning m-3" style="float: right;" onclick="filterCompletedOrders()"><i class="fas fa-clock menu-icon"></i> Tamamlanan Siparişler</button>


<table id="myTable" class="table table-striped mt-4 text-center">
    <thead>
        <tr>
            <th  style="width:50px;">ID</th>
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
                        <td><?php echo $order->table_num . " Numaralı masa"; ?></td>
                        <td><?php echo $order->product_name ?></td>
                        <td><?php echo $order->amount ?></td>
                        <td><?php echo $order->order_status == 0 ? '<span style="color: green;">Pending</span>' : 'tamamlandı'; ?></td>
                        <td><button type="button" class="btn btn-danger"><i class="fa-solid fa-bell-concierge"></i> Teslim Et</button></td>
                    </tr>
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