<?php include ("classes/abstractModel.php");
include ("classes/menu.php");
include ("includes/header.php");
include ("includes/sidebar.php"); 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $menu = new Menu();
    $result = $menu->addMenu();
    if($result){
        echo "Ürün Başarıyla Eklendi.";
    }else{
        echo "Bir Hata Oluştu.";
    }

}
?>
    <div class="container mt-5">
        <h1 class="mb-4">Ürün Ekle</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="product_name" class="form-label">Ürün Adı</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Fiyat</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <button type="submit" class="btn btn-primary">Ürün Ekle</button>
        </form>
    </div>
<?php include ("includes/footer.php")?>
