<?php
include ("classes/abstractModel.php");
include("classes/menu.php");
include ("includes/header.php");
include ("includes/sidebar.php"); 

$menu = new Menu();

?>

<table id="myTable" class="table table-striped mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ürün Adı</th>
            <th>Kategori</th>
            <th>Birim Fiyat</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if($menu->getAll())
            { 
                foreach($menu->getAll() as $menu)
                {
                    ?>
                    <tr>
                        <td><?php echo $menu->menu_id?></td>
                        <td><?php echo $menu->product_name?></td>
                        <td><?php echo $menu->category?></td>
                        <td><?php echo $menu->price?></td>
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