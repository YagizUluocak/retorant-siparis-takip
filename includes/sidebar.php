<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        padding-top: 60px; /* Navbar yüksekliği */
        background-color: #343a40;
        color: #fff;
    }

    /* Ana menü linkleri */
    .main-menu-link {
        color: #fff;
        text-decoration: none;
        display: block;
        padding: 10px 20px;
    }

    .main-menu-link:hover {
        background-color: #555;
    }

    /* Alt menü linkleri */
    .sub-menu-link {
        color: #bbb;
        text-decoration: none;
        display: block;
        padding: 5px 40px;
    }

    .sub-menu-link:hover {
        background-color: #666;
    }

    /* İçerik */
    .content {
        margin-left: 250px; /* Sidebar genişliği */
        padding: 20px;
    }

    /* Görünmez alt menü */
    .sub-menu {
        display: none;
    }

    /* Ok işareti */
    .arrow-icon {
        float: right;
        transition: transform 0.3s ease;
    }

    .arrow-icon.rotate {
        transform: rotate(90deg);
    }

    /* Menü simgeleri */
    .menu-icon {
        margin-right: 10px;
    }
</style>

<!-- Sidebar -->
<nav class="sidebar">
    <div class="sidebar-content">
        <h3>Menü</h3>
        <ul class="list-unstyled">
            <li>
                <a href="#" class="main-menu-link">
                    <i class="fas fa-table menu-icon"></i>
                    Masa İşlemleri
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <ul class="list-unstyled sub-menu">
                    <li><a href="masa-ekle.php" class="sub-menu-link">Masa Ekle</a></li>
                    <li><a href="masa-list.php" class="sub-menu-link">Masa Liste</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="main-menu-link">
                    <i class="fas fa-box menu-icon"></i>
                    Ürün İşlemleri
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <ul class="list-unstyled sub-menu">
                    <li><a href="urun-ekle.php" class="sub-menu-link">Ürün Ekle</a></li>
                    <li><a href="urun-list.php" class="sub-menu-link">Ürün Listesi</a></li>
                </ul>
            </li>
            <li >
                <a href="siparis-olustur.php" class="main-menu-link">
                    <i class="fas fa-cart-plus menu-icon"></i>
                    Sipariş Oluştur
                </a>
            </li>
            <li  class="mb-4" >
                <a href="siparisler.php" class="main-menu-link">
                    <i class="fas fa-clipboard-list menu-icon" ></i>
                    Tüm Siparişler
                </a>
            </li>

            <li >
                <a href="odemeler.php" class="main-menu-link" style="color:#66FF99; font-size:large">
                    <i class="fas fas fa-clock menu-icon"></i>
                    Ödemeler
                </a>
            </li>
        </ul>
    </div>
</nav>



<script>
    // Ana menü linklerine click event listener ekleyelim
    document.querySelectorAll('.main-menu-link').forEach(item => {
        item.addEventListener('click', event => {
            // Ana menü linkinin altındaki alt menüyü bulalım
            const subMenu = item.nextElementSibling;

            // Alt menü görünüyorsa gizleyelim, görünmüyorsa gösterelim
            if (subMenu.style.display === 'block') {
                subMenu.style.display = 'none';
                item.querySelector('.arrow-icon').classList.remove('rotate');
            } else {
                subMenu.style.display = 'block';
                item.querySelector('.arrow-icon').classList.add('rotate');
            }
        });
    });
</script>
