<?php
require "koneksi.php";

$nama = htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);

$queryProdukTerkait = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' AND id!='$produk[id]' LIMIT 4");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Detail Produk</title>
    <link rel="icon" type="image/png" href="img/logo.png"> <!-- Untuk PNG -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- <link href="css/style.css?v=2" rel="stylesheet"> -->
</head>

<body>
    <!-- heade  -->
    <?php require "navbar.php" ?>

    <!-- detail  -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-3">
                    <img src="img/<?php echo $produk['gambar'] ?>" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1> S<?php echo $produk['nama'] ?></h1>
                    <p class="fs-5"><?php echo $produk['detail'] ?> </p>
                    <p class=" badge text-bg-primary text-wrap" style="width: 11rem; height:2.5rem; font-size:1.5rem;">
                        Rp<?php echo $produk['harga'] ?>
                    </p>
                    <p class=" fs-4">
                        Stok : <strong><?php echo $produk['stok'] ?></strong>
                    </p>
                    <div class="d-grid gap-2">
                        <a href="https://wa.me/6282245417483?text=Saya Ingin Membeli Produk 
                        
                        nama :<?php echo $produk['nama']; ?>
                        harga :<?php echo $produk['harga']; ?>
                        Stok   :<?php echo $produk['stok']; ?>"
                            class="btn warnaWhatsapp">Order Via Whatsapp</a>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- produk terkait  -->
    <div class="container-fluid py-5 warna1 ">
        <div class="container">
            <h2 class="text-center text-white mb-5">Produk terkait</h2>
            <div class="row">
                <?php while ($data = mysqli_fetch_array($queryProdukTerkait)) { ?>
                    <div class="col-md-6 col-lg-3 mt-3">
                        <a href="produk-detail.php?nama=<?php echo $data['nama'] ?>">
                            <img src="img/<?php echo $data['gambar'] ?>" class="img-fluid img-thumbnail img-produk-terkait" alt="">
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php require "footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>