<?php include ("classes/abstractModel.php");
include ("classes/menu.php");
include("classes/table.php");
include("classes/order.php");
include ("includes/header.php");
include ("includes/sidebar.php"); 


$product = new Menu();
$masa = new Table();





if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $order = new Order();
    
    $result = $order->addOrder();
    if($result){
        echo "Ürün Başarıyla Eklendi.";
    }else{
        echo "Bir Hata Oluştu.";
    }

}
?>
    <div class="container mt-5">
        <h1 class="mb-4">Sipariş Oluştur</h1>
        <form method="POST">
            <div class="mb-3">
            <label for="table_id" class="form-label">Masa Numarası</label>
                <select class="form-select" aria-label="Default select example" name="table_id">
                    <?php
                    if($masa->getAll())
                    {   
                        foreach($masa->getAll() as $masa)
                        {
                            ?>
                            <option value="<?php echo $masa->table_id?>"><?php echo $masa->table_num?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
                        
            <div class="mb-3">
            <label for="product_name" class="form-label">Ürün seçiniz</label>
                <select class="form-select" aria-label="Default select example" name="product_id">
                    <?php
                    if($product->getAll())
                    {   
                        foreach($product->getAll() as $product)
                        {
                            ?>
                            <option value="<?php echo $product->menu_id?>"><?php echo $product->product_name?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Adet</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>





            <button type="submit" class="btn btn-primary">Ürün Ekle</button>
        </form>
    </div>
<?php include ("includes/footer.php")?>
