<head>
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php include __DIR__ . '/../header.php'; ?>

<main class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 my-5">
        <h3 class="text-center mb-3">Forgot Your Password?</h3>
        <p class="text-center text-muted">Enter your email address to reset your password.</p>
        
        <form method="POST" action="/sentPasswordResetEmail">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address" required>
            </div>
            <button type="submit" class="button" style="width: 100%;">Reset Password</button>
        </form>
    </div>
</main>

<?php include __DIR__ . '/../footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
