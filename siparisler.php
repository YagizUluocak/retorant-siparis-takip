<?php
include ("classes/abstractModel.php");
include("classes/order.php");
include ("includes/header.php");
include ("includes/sidebar.php"); 

$order = new Order();

?>

<table id="myTable" class="table table-striped mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Masa Numarası</th>
            <th>Ürün Adı</th>
            <th>Adet</th>
            <th>Sipariş Durumu</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if($order->getOrder())
            { 
                foreach($order->getOrder() as $order)
                {
                    ?>
                    <tr>
                        <td><?php echo $order->order_id?></td>
                        <td><?php echo $order->table_num . " Numaralı masa"?></td>
                        <td><?php echo $order->product_name?></td>
                        <td><?php echo $order->amount?></td>
                        <td><?php echo $order->order_status?></td>
                    </tr>
                    <?php
                }
            }
        ?>   
    </tbody>
</table>

<script>

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