<?php
require "session.php";
require "../koneksi.php";

$kategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($kategori);

$produk = mysqli_query($con, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($produk);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<style>

</style>

<body>
    <?php require "navbar.php" ?>
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-house"></i> Home
                </li>
            </ol>
        </nav>
        <h2>hallo <?php echo $_SESSION['username'] ?>
        </h2>
        <div class="container mt-2">
            <div class='row'>
                <div class="col-lg-6 col-md-6 col-12 mt-2"> <!--.bg-dark-subtle-->
                    <div class="bg-dark-subtle rounded-4 p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-list fa-7x"></i>
                            </div>
                            <div class="col-6">
                                <h3 class="fs-2">Kategori</h3>
                                <p class="fs-5"><?php echo $jumlahKategori; ?> kategori</p>
                                <p>
                                    <a href="kategori.php" class="btn btn-dark">Lihat details</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-2"> <!--.bg-dark-subtle-->
                    <div class="bg-secondary text-white-50 rounded-4 p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-boxes-stacked fa-7x"></i>
                            </div>
                            <div class="col-6">
                                <h3 class="fs-2">Produk</h3>
                                <p class="fs-5"><?php echo $jumlahProduk; ?> produk</p>
                                <p>
                                    <a href="produk.php" class="btn btn-light">Lihat detail</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>