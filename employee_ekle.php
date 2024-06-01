<?php include ("classes/abstractModel.php");
include ("classes/employee.php");
include ("includes/header.php");
include ("includes/sidebar.php"); 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $employee = new Employee();
    $result = $employee->addEmployee();
    if($result){
        echo "Personel Başarıyla Eklendi.";
    }else{
        echo "Bir Hata Oluştu.";
    }

}
?>
    <div class="container mt-5">
        <h1 class="mb-4">Personel Ekle</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="personel_name" class="form-label">Personel Adı</label>
                <input type="text" class="form-control" id="personel_name" name="personel_name" required>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Pozisyon</label>
                <input type="text" class="form-control" id="position" name="position" required>
            </div>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
    </div>
<?php include ("includes/footer.php")?>
