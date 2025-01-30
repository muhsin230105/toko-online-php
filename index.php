<?php
require "koneksi.php";
$queryProduk = mysqli_query($con, "SELECT id, nama, harga, gambar, detail FROM produk LIMIT 6");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Home</title>
    <link rel="icon" type="image/png" href="img/logo.png"> <!-- Untuk PNG -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <link href="css/style.css?v=2" rel="stylesheet">


</head>

<body>
    <?php require "navbar.php" ?>


    <!---------------------------------------------------- banner --------------------------------------------->
    <div id="carouselExample" class="carousel slide container mt-2 mb-2" data-bs-ride="carousel">
        <!-- Indikator (Dots) -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5"></button>
        </div>

        <!------------------------------------------- Gambar Banner -------------------------------------------->

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/banner1.jpg" class="d-block w-100" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="img/banner2.jpg" class="d-block w-100" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="img/banner3.jpg" class="d-block w-100" alt="Banner 3">
            </div>
            <div class="carousel-item">
                <img src="img/banner4.jpg" class="d-block w-100" alt="Banner 3">
            </div>
            <div class="carousel-item">
                <img src="img/banner5.jpg" class="d-block w-100" alt="Banner 3">
            </div>
        </div>

        <!-- Tombol Navigasi -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <!--------------------------------------------- baner jadul-------------------------------- -->
    <!--     
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white ">
            <h1 class="text-shadow">Elon Muhsin Store</h1>
            <h6 class="">pusat perbelanjaan komputer terlengkap</h6>
            <h3 class="text-shadow">Mau Cari Apa?</h3>
        </div>
    </div> -->


    <!---- highlighted kategori --------------------------------------------->
    <div class="container-fluid py-3">
        <div class="container text-center">
            <h3>Terlaris</h3>

            <div class="row mt-3">
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-terlaris-laptop d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=LAPTOP">LAPTOP</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-terlaris-hp d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=HP%20&%20TABLET">HP & TABLET</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-terlaris-aksesoris d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=AKSESORIS">AKSESORIS</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!---- Tentang kami --------------------------------------------->
    <div class="container-fluid warna3 py-5">
        <div class="container text-center">
            <h3>Tentang kami</h3>
            <p class="fs-6 mt-2">Jogjarobotika adalah toko elektronika murah di jogja yang melayani penjualan online dan offline.Jogjarobotika menyediakan berbagai komponen,sensor,arduino, keperluan robotika dan spare part running text.</p>
        </div>
    </div>

    <!-- produk -->
    <div class="container-fluid p-4 rounded-2 py-5">
        <div class="container">
            <h3 class="text-center">Produk</h3>
            <div class="row mt-5">
                <?php
                while ($data = mysqli_fetch_array($queryProduk)) {
                ?>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="img-box">
                                <img src="img/<?php echo $data['gambar']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data['nama']; ?><h5>
                                        <p class="card-text text-truncate text-body-tertiary"><?php echo $data['detail']; ?></p>
                                        <p class="card-text text-harga">Rp <?php echo $data['harga']; ?></p>
                                        <div class="d-flex flex-row">
                                            <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn warna4 w-50 me-2">Lihat detail</a>
                                            <a href="https://wa.me/6282245417483?text=Saya Ingin Membeli Produk --> <?php echo $produk['nama']; ?>" class="btn warnaWhatsapp w-50"><i class="fa-brands fa-whatsapp"> </i> Pesan</a>
                                        </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                <a class="btn btn-info" href="produk.php">Lebih Lengkap</a>
            </div>
        </div>
    </div>


    <!-- footer -->
    <?php require "footer.php" ?>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>