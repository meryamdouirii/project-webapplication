<head>
    <title>Manage My Account</title>
    <link rel="stylesheet" href="/path/to/your/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>

<main class="container d-flex justify-content-center align-items-center" style="margin-top:80px; margin-bottom:5%;">
    <div class="w-75">
        <!-- Personal Information Form -->
        <div class="card shadow-sm p-4 my-3">
            <h3 class="text-center">Manage Account</h3>
            <div id="error-message" style="display: none;" class="alert alert-danger" role="alert"></div>
            <form action="/updateAccount" method="POST">
                <div class="card p-3 mb-3 border-0">
                    <h5 class="card-title">Personal Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $_SESSION['user']['first_name']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $_SESSION['user']['last_name']; ?>" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $_SESSION['user']['phone_number']; ?>" required>
                    </div>
                </div>

                <div class="card p-3 mb-3 border-0">
                    <h5 class="card-title">Login Credentials</h5>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required value="<?php echo $_SESSION['user']['email']; ?>">
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Save</button>
                    <a href="/" class="btn btn-secondary px-4">Cancel</a>
                </div>
            </form>
        </div>

        <!-- Change Password Form -->
        <div class="card shadow-sm p-4 my-3">
            <h4 class="text-center">Change Password</h4>
            <form action="/changePassword" method="POST">
                <div class="card p-3 mb-3 border-0">
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_new_password" class="form-label">Confirm New Password</label>
                        <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning px-4">Update Password</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</main>

<?php include __DIR__ . '/../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>