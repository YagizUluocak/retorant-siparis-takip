
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

        /* Sidebar içeriği */
        .sidebar-content {
            padding: 20px;
        }

        /* Sidebar linkleri */
        .sidebar-link {
            color: #fff;
            text-decoration: none;
        }

        .sidebar-link:hover {
            color: #fff;
            text-decoration: underline;
        }

        /* İçerik */
        .content {
            margin-left: 250px; /* Sidebar genişliği */
            padding: 20px;
        }
    </style>

    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-content">
            <h3>Menü</h3>
            <ul class="list-unstyled">
                <li><a href="masa-ekle.php" class="sidebar-link">Masa Ekle</a></li>
                <li><a href="urun-ekle.php" class="sidebar-link">Ürün Ekle</a></li>
            </ul>
        </div>
    </nav>


