<?php
require "session.php";
require "../koneksi.php";


$kategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($kategori);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
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
                    <i></i>Kategori
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tmabah kategori</h3>

            <form action="" method="post">
                <div class="mt-1">
                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="input nama" class="form-control border-dark">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                </div>
            </form>
            <?php
            if (isset($_POST['simpan_kategori'])) {
                $kategor = htmlspecialchars($_POST['kategori']);

                $ceknama = mysqli_query($con, "SELECT nama FROM kategori WHERE nama='$kategor'");
                $jumlahDataKategoriBaru = mysqli_num_rows($ceknama);

                if ($jumlahDataKategoriBaru > 0) {
            ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Kategori yang anda masukan sudah ada !
                    </div>
                    <?php
                } else {
                    $querysimpan = mysqli_query($con, "INSERT INTO kategori (nama) VALUES('$kategor')");
                    if ($querysimpan) {
                    ?>
                        <div class="alert alert-info mt-3" role="alert">
                            Berhasil di tambahkan !
                            <meta http-equiv="refresh" content="1; url=kategori.php">
                        </div>
            <?php
                    } else {
                        echo mysqli_error($con);
                    }
                }
            }
            ?>
        </div>
        <!-- ----------------------------------list kategori------------------------------------------  -->
        <div class="mt-3">
            <h2>List Kategori</h2>
            <div class="table-responsive mt-3">
                <table class="table p-3 border-dark">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if ($jumlahKategori == 0) {
                        ?>
                            <tr>
                                <td colspan=3 class="text-center">Data masih kosong</td>
                            </tr>
                            <?php
                        } else {
                            $number = 1;
                            while ($data = mysqli_fetch_array($kategori)) {
                            ?>
                                <tr>
                                    <td><?php echo $number; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td>
                                        <a href="kategori-detail.php?idKategori=<?php echo $data['id'] ?>" class="btn btn-info"><i class="fa-solid fa-magnifying-glass"></i></i></a>
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