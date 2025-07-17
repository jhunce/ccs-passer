<?php
session_start();

// If already logged in, redirect to admin panel
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    // Hardcoded credentials (for demo)
    $valid_user = 'admin';
    $valid_pass = '@Admin24@ccs';
    if ($username === $valid_user && $password === $valid_pass) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6fa; }
        .login-card {
            max-width: 400px;
            margin: 60px auto;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(128,0,0,0.15);
            overflow: hidden;
        }
        .login-banner {
            background: linear-gradient(135deg, #800000 0%, #b22222 100%);
            color: #fff;
            padding: 32px 0 16px 0;
            text-align: center;
        }
        .login-banner img {
            max-width: 70px;
            margin-bottom: 10px;
        }
        .login-banner .fa-user-shield {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .login-card .card-body {
            padding: 2rem 2rem 1.5rem 2rem;
        }
        .form-label {
            font-weight: 500;
        }
        .form-control:focus {
            border-color: #b22222;
            box-shadow: 0 0 0 0.2rem rgba(128,0,0,0.08);
        }
        .btn-primary {
            background: linear-gradient(135deg, #800000 0%, #b22222 100%) !important;
            border: none !important;
            border-radius: 25px;
            padding: 12px 30px;
            color: #fff !important;
            font-weight: 600;
            letter-spacing: 1px;
        }
        .show-password {
            cursor: pointer;
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #b22222;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card card">
            <div class="login-banner">
                <!-- Use your logo or fallback to icon -->
                <img src="images/ccslogo.png" alt="Logo" onerror="this.style.display='none';this.nextElementSibling.style.display='inline-block';">
                <span class="fa fa-user-shield d-none"></span>
                <h4 class="mt-2 mb-0">Admin Login</h4>
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger mb-3"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required autofocus>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <span class="show-password" onclick="togglePassword()"><i class="fa fa-eye"></i></span>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-2">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            var pwd = document.getElementById('password');
            var icon = document.querySelector('.show-password i');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                pwd.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html> 