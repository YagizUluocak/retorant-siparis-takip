<?php
include ("classes/abstractModel.php");
include("classes/table.php");
include ("includes/header.php");
include ("includes/sidebar.php"); 

$masa = new Table();

?>

<table id="myTable" class="table table-striped mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Masa Numarası</th>
            <th>Kapasite</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if($masa->getAll())
            { 
                foreach($masa->getAll() as $masa)
                {
                    ?>
                    <tr>
                        <td><?php echo $masa->table_id?></td>
                        <td><?php echo $masa->table_num ." Numaralı Masa"?></td>
                        <td><?php echo $masa->capacity?></td>
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