<?php
require "koneksi.php";
$queryProduk = mysqli_query($con, "SELECT id, nama, harga, gambar, detail FROM produk LIMIT 6");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <?php require "navbar.php" ?>


    <!---------------------------------------------------- banner --------------------------------------------->

    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white ">
            <h1 class="text-shadow">Jogja Robotika</h1>
            <h3 class="text-shadow">Mau Cari Apa?</h3>
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Barang" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn warna2 text-white">Telusuri</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!---- highlighted kategori --------------------------------------------->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Terlaris</h3>

            <div class="row mt-3">
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-terlaris-ardunio d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=controler">CONTROLER</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-terlaris-servo d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=servo">SERVO</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-terlaris-ic d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=ic">IC</a></h4>
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
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>
            <div class="row mt-5">
                <?php
                while ($data = mysqli_fetch_array($queryProduk)) {
                ?>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="card">
                            <div class="img-box">
                                <img src="img/<?php echo $data['gambar']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data['nama']; ?><h5>
                                        <p class="card-text text-truncate text-body-tertiary"><?php echo $data['detail']; ?></p>
                                        <p class="card-text text-harga">Rp <?php echo $data['harga']; ?></p>
                                        <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn warna4">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>