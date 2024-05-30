<?php include ("includes/header.php");?>
    <?php include ("includes/sidebar.php"); ?>
    
    <div class="container mt-5">
        <h1 class="mb-4">Masa Ekle</h1>
        <form action="masa_ekle.php" method="POST">
            <div class="mb-3">
                <label for="table_name" class="form-label">Masa Adı</label>
                <input type="text" class="form-control" id="table_name" name="table_name" required>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Kapasite</label>
                <input type="number" class="form-control" id="capacity" name="capacity" required>
            </div>
            <button type="submit" class="btn btn-primary">Masa Ekle</button>
        </form>
    </div>

<?php include ("includes/footer.php")?>