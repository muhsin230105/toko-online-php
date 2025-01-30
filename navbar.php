<?php
// Ambil nama file dari URL
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- --------------------------------Header------------------------------------------------- -->
<header class="warna3 py-3">
    <div class="container d-flex flex-column flex-lg-row align-items-center justify-content-between">

        <!-- Nama Toko -->
        <div class="d-flex align-items-center">
            <img src="img/logo.png" alt="Logo" style="height: 50px;" class="me-2">
            <div>
                <h2 class="text-white mb-0">Elon Muhsin Store</h2>
                <h6 class="text-white mb-0">Pusat belanja komputer terlengkap</h6>
            </div>
        </div>

        <!-- Search -->
        <div class="w-50 w-lg-50 mt-3">
            <form method="get" action="produk.php">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari produk..." name="keyword">
                    <button type="submit" class="btn btn-dark">🔍</button>
                </div>
            </form>
        </div>

        <!-- Kontak -->
        <div class="text-end text-white mt-3 ">
            <p class="mb-0"><a href="https://wa.me/6282245417483" class="no-decoration fa-brands fa-whatsapp fs-5"></a><strong> 082225625757</strong></p>
        </div>

    </div>
</header>
<!-------------------------------------------- navbar  --------------------------------------------------->

<nav class="navbar navbar-expand-lg warna1 ">
    <div class="container mt-2 mb-2 d-lg-flex justify-content-between">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-3 mb-lg-0">
                <li class="nav-item me-3">
                    <a class="nav-link <?= $current_page == 'index.php' ? 'active' : '' ?>" href="index.php">Beranda</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link <?= $current_page == 'tentang-kami.php' ? 'active' : '' ?>" href="tentang-kami.php">Tentang Kami</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link <?= $current_page == 'produk.php' ? 'active' : '' ?>" href="produk.php">Produk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>