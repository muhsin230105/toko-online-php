<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['idKategori'];
$query = mysqli_query($con, "SELECT * FROM kategori WHERE id='$id'");
$data = mysqli_fetch_array($query);
#var_dump($data);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kategori-detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php require "navbar.php" ?>

    <div class="container mt-5">

        <h2>Detail Kategori</h2>
        <div class="col-12 col-md-6">
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control border-dark" value="<?php echo $data['nama'] ?>">
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <button type="submit" class="btn btn-outline-primary" name="editBtn">Ebit</button>
                    <button type="submit" class="btn btn-outline-danger" name="hapusBtn">Hapus</button>
                </div>
            </form>
            <?php
            if (isset($_POST['editBtn'])) {
                $kategori = htmlspecialchars($_POST['kategori']);

                if ($data['nama'] == $kategori) {
            ?>
                    <meta http-equiv="refresh" content="0; url=kategori.php">
                    <?php
                } else {
                    $query = mysqli_query($con, "SELECT * FROM kategori WHERE nama='$kategori'");
                    $jumlahData = mysqli_num_rows($query);

                    if ($jumlahData > 0) {
                    ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            Kategori yang anda masukan sudah ada !
                        </div>
                        <?php
                    } else {
                        $querySimpan = mysqli_query($con, "UPDATE kategori SET nama ='$kategori' WHERE id='$id'");
                        if ($querySimpan) {
                        ?>
                            <div class="alert alert-info mt-3" role="alert">
                                Berhasil di edit !
                                <meta http-equiv="refresh" content="0.5; url=kategori.php">
                            </div>
                    <?php
                        }
                    }
                }
            }
            if (isset($_POST['hapusBtn'])) {

                $queryCheck = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$id'");
                $dataCount = mysqli_num_rows($queryCheck);
                if ($dataCount) {
                    ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Tidak Bisa Di Hapus, Ktegori Udah di Gunakan Dalam Produk
                    </div>
                <?php
                };


                $querryHapus = mysqli_query($con, "DELETE FROM kategori WHERE id='$id'");
                if ($querryHapus) {
                ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Berhasil di hapus !
                        <meta http-equiv="refresh" content="1; url=kategori.php">
                    </div>
            <?php
                } else {
                }
            }
            ?>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>