<?php

$title = 'KOMPUTER.CO';
include 'header.php';

if (isset($_POST['kirim_data'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $system->login($username, $password);
}

?>

<style>
    .login {
    min-height: 100vh;
    }

    .bg-image {
    background-image: url('https://images-ext-1.discordapp.net/external/3qCkvrdnIS7DZvGVMUjeqnvpod_3Zc7JUB7CD6yGm6Q/https/i.pinimg.com/564x/f2/52/3d/f2523d4dec4307923fa87767d039e444.jpg?format=webp&width=846&height=475');
    background-size: cover;
    background-position: center;
    }

    .login-heading {
    font-weight: 300;
    }

    .btn-login {
    font-size: 0.9rem;
    letter-spacing: 0.05rem;
    padding: 0.75rem 1rem;
    }

</style>

<body class="bg-dark text-white">

    <div class="container-fluid ps-md-0">
    <div class="row g-0">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
        <div class="col-md-8 col-lg-6">
        <div class="login d-flex align-items-center py-5">
            <div class="container">
            <div class="row">
                <div class="col-md-9 col-lg-8 mx-auto">
                <h3 class="login-heading mb-4">LOGIN</h3>
                
                <div class="flash">
                    <?= Flasher::flash() ?>
                </div>
            
                <!-- Sign In Form -->
                <form action="" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control text-dark" id="username" autocomplete="off" placeholder="Username" required>
                        <label for="username" class="form-label text-dark">Username</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control text-dark" id="pass"  placeholder="Password" required>
                        <label for="pass" class="form-label text-dark">Password</label>
                    </div>


                    <div class="d-grid">
                    <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" name="kirim_data" type="submit">LOGIN</button>
                    <div class="text-center">
                        <p class="small">UAS</p>
                    </div>
                    </div>

                </form>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>



</body>