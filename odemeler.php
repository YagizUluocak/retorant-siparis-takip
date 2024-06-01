<?php
include ("classes/abstractModel.php");
include("classes/payment.php");
include ("includes/header.php");
include ("includes/sidebar.php"); 

$payment = new Payment();

?>

<table id="myTable" class="table table-striped mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Sipariş Numarası</th>
            <th>Masa Adı</th>
            <th>Ürün Adı</th>
            <th>Adet</th>
            <th>Toplam Tutar</th>
            <th>Ödeme Durumu</th>
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
                        <td><?php echo $pay->product_name?></td>
                        <td><?php echo $pay->total_quantity?></td>
                        <td><?php echo $pay->total_price?></td>
                        <td><?php echo $pay->payment_status?></td>
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