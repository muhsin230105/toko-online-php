<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['idProduk'];

$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id  WHERE a.id='$id'");
$data = mysqli_fetch_array($query);

$queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>produk-detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<style>
    form div {
        margin-bottom: 10px;
    }

    .form-control {
        border-radius: 2px;
    }
</style>

<body>
    <?php require "navbar.php" ?>

    <div class="container mt-5">

        <h2>Detail Produk</h2>
        <div class="col-12 col-md-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>" class="form-control" autocomplete="off">
                </div>
                <div>
                    <label for="kategori" class="p-1">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori']; ?></option>
                        <?php
                        while ($dataKategori = mysqli_fetch_array(($queryKategori))) {
                        ?>
                            <option value=" <?php echo $dataKategori['id']; ?>"><?php echo $dataKategori['nama']; ?></option>


                        <?php

                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga" class="p-1">Harga</label>
                    <input type="number" class="form-control" value="<?php echo $data['harga']; ?>" name="harga" required>
                </div>
                <div>
                    <label for="currenGambar">Gambar Produk</label>
                    <img src="../img/<?php echo $data['gambar']; ?>" alt="" width="300px" class="form-control">
                </div>
                <div>
                    <label for="gambar" class="p-1">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"><?php echo $data['detail']; ?></textarea>
                </div>
                <div>
                    <label for="stok" class="p-1">Stok</label>
                    <select name="stok" id="stok" class="form-control">
                        <option value="<?php echo $data['stok']; ?>"><?php echo $data['stok']; ?></option>
                        <?php
                        if ($data['stok'] == 'tersedia') {
                        ?>
                            <option value="Habis">Habis</option>
                        <?php
                        } else {
                        ?>
                            <option value="tersedia">Tersedia</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <button type="submit" name="simpan" class="btn btn-dark mt-4">Simpan</button>
                    <button type="submit" name="hapus" class="btn btn-danger mt-4">Hapus</button>
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
                    $queryUpdate = mysqli_query($con, "UPDATE produk SET kategori_id='$kategori', nama='$nama', harga='$harga',detail='$detail', stok='$stok' WHERE id=$id");

                    if ($nama_file != "") {
                        if ($image_size > 500000) { //500kb//
                    ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                file tidak boleh lebih dari 5mb !
                            </div>
                            <?php
                        } else {
                            if ($imageFileType !== 'jpg' && $imageFileType !== 'png') {
                            ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    format file harus jpg/png !
                                </div>
                                <?php
                            } else {
                                move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_dir . $new_name);

                                $queryUpdate = mysqli_query($con, "UPDATE produk SET gambar='$new_name' WHERE id='$id'");
                                if ($queryUpdate) {
                                ?>
                                    <div class="alert alert-primary mt-3" role="alert">
                                        produk berhasil di Edit !
                                    </div>
                                    <meta http-equiv="refresh" content="2; url=produk.php" />
                        <?php

                                } else {
                                    echo mysqli_error($con);
                                }
                            }
                        }
                    } else {
                        ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            produk berhasil di Edit !
                        </div>
                        <meta http-equiv="refresh" content="2; url=produk.php" />
                    <?php
                    }
                }
            }
            if (isset($_POST['hapus'])) {
                $queryHapus = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");

                if ($queryHapus) {
                    ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        produk berhasil di Hapus !
                    </div>
                    <meta http-equiv="refresh" content="2; url=produk.php" />
            <?php
                }
            }
            ?>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>