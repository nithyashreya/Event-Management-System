<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/form-style.css">
</head>
<body>

<div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
    <div class="row no-gutters w-100" style="max-width: 800px;">
        <!-- Left Side -->
        <div class="col-md-6 left-side d-flex flex-column justify-content-center align-items-center">
            <h2>Welcome Admin!</h2>
            <p>Log in to manage and organize the events effectively.</p>
        </div>

        <!-- Right Side (Admin Login Form) -->
        <div class="col-md-6 right-side d-flex flex-column justify-content-center">
            <h3 class="text-center">Admin Login</h3>
            <form action="admin_login_process.php" method="POST" class="w-100 px-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="admin_username" placeholder="Admin Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="admin_password" placeholder="Admin Password" required>
                </div>
                <button type="submit" class="btn btn-block">Login</button>
                <div class="mt-3 text-center small-text">
                    <p>Not an admin? <a href="login.php">Click here to login as a user</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
