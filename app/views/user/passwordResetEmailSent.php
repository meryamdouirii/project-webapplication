<head>
    <title>Reset password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php include __DIR__ . '/../header.php'; ?>

<main class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 my-5" style="width:30%">
        <h3 class="mb-3">Check Your Email</h3>
        <p class="text-muted">
            If your email address is registered with us, you will receive a password reset link within a few minutes.<strong> This link is valid for 24 hours. </strong>
        </p>
        <p class="text-muted">
            Didn’t receive an email? Check your spam folder or ensure that your account is activated.
        </p>
        <a href="/login" class="button">Back to Login</a>
    </div>
</main>

<?php include __DIR__ . '/../footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
