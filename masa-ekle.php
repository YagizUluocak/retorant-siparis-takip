<?php 
include ("classes/abstractModel.php");
include ("classes/table.php");
include ("includes/header.php");
include ("includes/sidebar.php"); 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $table = new Table();
    $result = $table->addTable();
    if($result){
        echo "Masa Başarıyla Eklendi.";
    }else{
        echo "Bir Hata Oluştu.";
    }

}

?>
    
    <div class="container mt-5">
        <h1 class="mb-4">Masa Ekle</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="table_num" class="form-label">Masa Numarası</label>
                <input type="number" class="form-control" id="table_num" name="table_num" required>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Kapasite</label>
                <input type="number" class="form-control" id="capacity" name="capacity" required>
            </div>
            <button type="submit" class="btn btn-primary">Masa Ekle</button>
            
        </form>
    </div>

<?php include ("includes/footer.php")?>