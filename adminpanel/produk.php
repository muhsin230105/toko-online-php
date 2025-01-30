<?php
require "session.php";
require "../koneksi.php";

// Query untuk mengambil data produk
$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
$jumlahProduk = mysqli_num_rows($query);

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");


// membuat random string untuk nama gambar
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}

// jika tombol hapus di tekan 
if (isset($_POST['hapus'])) {
    $idProduk = $_POST['idProduk'];

    // Ambil nama gambar produk sebelum menghapus dari database
    $queryGambar = mysqli_query($con, "SELECT gambar FROM produk WHERE id = '$idProduk'");
    $dataGambar = mysqli_fetch_assoc($queryGambar);
    $gambarHapus = $dataGambar['gambar'];

    // Query untuk menghapus produk berdasarkan ID
    $queryHapus = mysqli_query($con, "DELETE FROM produk WHERE id = '$idProduk'");

    if ($queryHapus) {
        // Menghapus gambar dari server
        $filePath = "../img/" . $gambarHapus;
        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file gambar
        }

        echo '<div class="alert alert-success mt-3" role="alert">
                Produk berhasil dihapus.
              </div>';
        echo '<meta http-equiv="refresh" content="0.5; url=produk.php" />';
    } else {
        echo '<div class="alert alert-danger mt-3" role="alert">
                Gagal menghapus produk. ' . mysqli_error($con) . '
              </div>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>



<body>
    <?php require "navbar.php" ?>
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel/" class="text-decoration-none text-body-tertiary">
                        <i class="fa-solid fa-house"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i></i>Produk
                </li>
            </ol>
        </nav>


        <!-- tambah produk -->

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Produk</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" autocomplete="off">
                </div>
                <div>
                    <label for="kategori" class="p-1">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">pilih kategori</option>
                        <?php
                        while ($data = mysqli_fetch_array(($queryKategori))) {
                        ?>
                            <option value="<?php echo $data['id'] ?>"><?php echo $data['nama'] ?></option>
                        <?php

                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga" class="p-1">Harga</label>
                    <input type="number" class="form-control" name="harga">
                </div>
                <div>
                    <label for="gambar" class="p-1">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div>
                    <label for="stok" class="p-1">Stok</label>
                    <select name="stok" id="stok" class="form-control">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Habis">Habis</option>
                    </select>
                    <div>
                        <button type="submit" name="simpan" class="btn btn-outline-dark mt-4">Simpan</button>
                    </div>
                </div>
            </form>

            <?php
            if (isset($_POST['simpan'])) {
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $stok = htmlspecialchars($_POST['stok']);


                $target_dir = "../img/";
                $nama_file = basename($_FILES["gambar"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $image_size = $_FILES["gambar"]['size'];
                $random_name = generateRandomString(5);
                $new_name = $random_name . "." . $imageFileType;


                if ($nama == '' || $kategori == '' || $harga == '' || $detail == '') {
            ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Semua data harus di isi!
                    </div>
                    <?php
                } else {
                    if ($nama_file !== "") {
                        if ($image_size > 5000000) { //500kb//
                    ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                file tidak boleh lebih dari 500kb !
                            </div>
                            <?php
                        } else {
                            if ($imageFileType !== 'jpg' && $imageFileType !== 'png' && $imageFileType !== 'webp') {
                            ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    format file harus jpg/png/webp !
                                </div>
                        <?php
                            } else {
                                move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_dir . $new_name);
                            }
                        }
                    }
                    $queryTambah = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, harga, gambar, detail, stok) VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$stok' )");

                    if ($queryTambah) {
                        ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            produk berhasil di tambahkan
                        </div>
                        <meta http-equiv="refresh" content="2; url=produk.php" />
            <?php
                    } else {
                        echo mysqli_error($con);
                    }
                }
            }
            ?>
        </div>

        <!------------------- lis produk-----------------------  -->

        <div class="mt-3">
            <h2>List Produk</h2>
            <div class="table-responsive mt-3">
                <table class="table border-dark">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahProduk == 0) {
                        ?>
                            <tr>
                                <td colspan=6 class="text-center">Data produk kosong</td>
                            </tr>
                            <?php
                        } else {
                            $number = 1;
                            while ($data = mysqli_fetch_array($query)) {

                            ?>
                                <tr>
                                    <td><?php echo $number ?></td>
                                    <td><?php echo $data['nama'] ?></td>
                                    <td><?php echo $data['nama_kategori'] ?></td>
                                    <td><?php echo $data['harga'] ?></td>
                                    <td><?php echo $data['stok'] ?></td>
                                    <td class="text-center">
                                        <a href="produk-detail.php?idProduk=<?php echo $data['id'] ?>" class="btn btn-info"><i class="fa-solid fa-magnifying-glass"></i></a>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="idProduk" value="<?php echo $data['id']; ?>">
                                            <button type="submit" name="hapus" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                        <?php
                                $number++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>