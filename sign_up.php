<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/form-style.css">
</head>
<body>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="row no-gutters w-100" style="max-width: 800px;">
        <!-- Left Side -->
        <div class="col-md-6 col-xs-4 left-side d-flex flex-column justify-content-center align-items-center">
            <h2>Welcome to the Event Management System!</h2>
            <p>Sign up now to participate in exciting events and stay updated.</p>
        </div>

        <!-- Right Side (Sign-up Form) -->
        <div class="col-md-6 right-side d-flex flex-column justify-content-center">
            <h3 class="text-center">Create an Account</h3>
            <form action="sign_up_process.php" method="POST" class="w-100 px-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="College Email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-block">Sign Up</button>
                <div class="mt-3 text-center small-text">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                    <p>If you are an admin, <a href="admin_login.php">click here</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
