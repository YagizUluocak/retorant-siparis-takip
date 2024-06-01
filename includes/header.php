<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Takip Uygulaması</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

</head>

<body style="margin-left: 250px;">

<style>
        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            transform: translate(25%, -25%);
            background-color: red;
            border-radius: 50%;
            color: white;
            font-size: 0.7rem;
            width: 1.2rem;
            height: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg" style="background-color: #343a40;">
  <div class="container">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Menü içeriği buraya gelecek -->
    </div>
    <div class="ml-auto">
        <!-- Mesaj kutusu ve bildirim simgesi -->
        <div class="position-relative">
            <a class="nav-link" href="#"><i class="fas fa-envelope"></i></a>
            <!-- Bildirim simgesi -->
            <!-- Mesaj kutusu -->
            <div class="position-absolute border bg-light p-2" style="width: 300px; right: 0; top: 100%; display: none;">

            </div>
        </div>
        <!-- Çıkış simgesi -->
        <a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i></a>
    </div>
  </div>
</nav>