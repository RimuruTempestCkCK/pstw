<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login - Sistem Prediksi Pola Perilaku Lansia</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./css/style.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #593bdb;
            --secondary-color: #a020f0;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .auth-info-side {
            flex: 1;
            background: #fff;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #333;
            text-align: center;
            border-right: 1px solid #f0f0f0;
        }

        .auth-form-side {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fafafa;
        }

        .login-logo {
            max-width: 320px;
            margin-bottom: 30px;
        }

        .brand-name {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.2;
            background: linear-gradient(135deg, #a020f0 0%, #ff69b4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-subtitle {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
            max-width: 80%;
        }

        .auth-form h4 {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .auth-form p {
            color: #777;
            margin-bottom: 30px;
        }

        .form-group label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }

        .form-control {
            height: 50px;
            border-radius: 10px;
            border: 1px solid #e1e1e1;
            padding: 10px 20px;
            transition: all 0.3s;
            background: #fff;
        }

        .form-control:focus {
            border-color: #a020f0;
            box-shadow: 0 0 0 0.2rem rgba(160, 32, 240, 0.1);
        }

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
            z-index: 10;
            transition: color 0.3s;
        }

        .toggle-password:hover {
            color: #a020f0;
        }

        .btn-primary {
            background: linear-gradient(135deg, #a020f0 0%, #ff69b4 100%);
            border: none;
            height: 50px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s;
            margin-top: 10px;
            color: #fff;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(160, 32, 240, 0.3);
            opacity: 0.9;
        }

        .alert {
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: #aaa;
        }

        @media (max-width: 991px) {
            .auth-info-side {
                display: none;
            }
            .auth-card {
                max-width: 500px;
            }
        }
    </style>
</head>

<body class="h-100">
    <div class="auth-container">
        <div class="auth-card">
            <!-- Info Side (Hidden on Mobile) -->
            <div class="auth-info-side">
                <img src="images/pstw.png" alt="Logo PSTW" class="login-logo">
                <h2 class="brand-name">PSTW Kasih Sayang Ibu</h2>
                <p class="brand-subtitle">Sistem Prediksi Pola Perilaku Lansia menggunakan Metode Random Forest</p>
                <div class="mt-4">
                    <!-- <small>© 2024 - Unit Pelaksana Teknis Daerah</small> -->
                </div>
            </div>

            <!-- Form Side -->
            <div class="auth-form-side">
                <div class="auth-form">
                    <div class="text-center d-lg-none mb-4">
                        <img src="images/pstw.png" alt="Logo PSTW" width="200">
                    </div>
                    <h4>Selamat Datang</h4>
                    <p>Silakan masuk ke akun Anda untuk melanjutkan.</p>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Gagal!</strong> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="proses/login_proses.php" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required placeholder="Masukkan username">
                        </div>
                        <div class="form-group">
                            <label>Kata Sandi</label>
                            <div class="password-container">
                                <input type="password" name="password" id="password" class="form-control" required placeholder="Masukkan kata sandi">
                                <i class="fa fa-eye toggle-password" id="togglePassword"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Masuk Sekarang</button>
                    </form>
                    
                    <div class="footer-text">
                        <p>Butuh bantuan? Hubungi Administrator Sistem</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
