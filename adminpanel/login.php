<?php
session_start();
require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style.css?v=2" rel="stylesheet">
</head>
<style>
    .main {
        height: 100vh;
        display: flex;

    }

    .back1 {
        background-color: #3e424b;
    }

    .back2 {
        background-color: #D9DDDC;
    }

    .login-box {
        width: 550px;
        height: 400px;
        padding: 20px;
        box-sizing: border-box;
        border-radius: 20px;
    }
</style>

<body>

    <div class="main d-flex flex-colum justify-content-center align-items-center row back1">
        <div class="login-box p-5 shadow back2">
            <div class="text-center text-b mb-5">
                <h1>Login Admin Toko</h1>
            </div>
            <form action="" method="post">
                <div>
                    <label for="validationServerUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username"></input>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password"></input>
                </div>
                <div>
                    <button type="submit" class="btn btn-secondary form-control mt-3" name="loginbtn">Login</button>
                </div>
            </form>
            <div class="mb-5 mt-5"></div>
            <div class="mt-5">
                <?php
                if (isset($_POST['loginbtn'])) {
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);

                    $query = mysqli_query($con, "SELECT * FROM users WHERE 
                username ='$username'");
                    $countdata = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);


                    if ($countdata > 0) {
                        if (password_verify($password, $data['password'])) {
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['login'] = true;
                            header('location:index.php');
                        } else {
                ?>
                            <div class="alert alert-info" role="alert">
                                Password salah !
                            </div>
                        <?php
                        }
                    } else {

                        ?>
                        <div class="alert alert-info" role="alert">
                            username salah!
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>