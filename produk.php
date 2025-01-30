<?php
require "koneksi.php";

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");
// get prouduk by nama produk/ keyword
if (isset($_GET['keyword'])) {
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
}
//get pruduk default
else if (isset($_GET['kategori'])) {
    // Menangani input dengan mysqli_real_escape_string untuk menghindari SQL injection
    $kategori = mysqli_real_escape_string($con, $_GET['kategori']);
    $queryGetKategoriId = mysqli_query($con, "SELECT id FROM kategori WHERE nama LIKE '%$kategori%'");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId);

    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
}
// get produk kategori 
else {
    $queryProduk = mysqli_query($con, "SELECT * FROM produk");
}

$countData = mysqli_num_rows($queryProduk);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Produk</title>
    <link rel="icon" type="image/png" href="img/logo.png"> <!-- Untuk PNG -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- <link href="css/style.css?v=2" rel="stylesheet"> -->
</head>

<body>
    <?php require "navbar.php" ?>

    <!-- bener  -->
    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-shadow text-center">Pusat Belanja komputer Terlengkap</h1>

        </div>
    </div>
    <!-- produk -->

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-2 mb-4">
                <ul class="list-group">
                    <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                        <a class="no-decoration" href="produk.php?kategori=<?php echo $kategori['nama'] ?>">
                            <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                        </a>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-lg-10">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                    <?php
                    if ($countData < 1) {
                    ?>
                        <h5 class="text-center my-5">Produk Tidak Tersedia</h5>
                    <?php
                    }
                    while ($produk = mysqli_fetch_array($queryProduk)) {
                    ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="img-box-produk">
                                    <img src="img/<?php echo $produk['gambar']; ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $produk['nama']; ?><h5>
                                            <p class="card-text text-truncate text-body-tertiary"><?php echo $produk['detail']; ?></p>
                                            <p class="card-text text-harga">Rp <?php echo $produk['harga']; ?></p>
                                            <div class="d-flex flex-row">
                                                <a href="produk-detail.php?nama=<?php echo $produk['nama']; ?>" class="btn warna4 w-50 me-2">Lihat Detail</a>
                                                <a href="https://wa.me/6282245417483?text=Saya Ingin Membeli Produk --> <?php echo $produk['nama']; ?>" class="btn warnaWhatsapp w-50"><i class="fa-brands fa-whatsapp"></i> Pesan</a>
                                            </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>