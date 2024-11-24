<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/form-style.css">
</head>
<body>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="row no-gutters w-100" style="max-width: 800px;">
        <!-- Left Side -->
        <div class="col-md-6 left-side d-flex flex-column justify-content-center align-items-center">
            <h2>Welcome Back!</h2>
            <p>Log in to manage or participate in exciting events.</p>
        </div>

        <!-- Right Side (Login Form) -->
        <div class="col-md-6 right-side d-flex flex-column justify-content-center">
            <h3 class="text-center">Login to Your Account</h3>
            <form action="login_process.php" method="POST" class="w-100 px-4">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="College Email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-block">Login</button>
                <div class="mt-3 text-center small-text">
                    <p><a href="forgot_password.php">Forgot your password?</a></p>
                    <p>Don't have an account? <a href="sign_up.php">Sign up here</a></p>
                    <p>If you are an admin, <a href="admin_login.php">click here</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
