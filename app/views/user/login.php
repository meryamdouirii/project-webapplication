<head>
    <title>Log In</title>
</head>
<?php
include __DIR__ . '/../header.php';?>
<main class="container d-flex justify-content-center align-items-center vh-100">     
    <div class="card p-4 my-5" style="width: 35%;">
        <h3 class="text-center">Login</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Enter you email address" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="button">Log In</button>
            <div style="padding-top:10%;"class="mb-3 d-flex flex-column align-items-start">
                <strong>Don't have an account?</strong>
                <a href="/register">Make an account</a>
            </div>
            
        </form>
    </div>
</main>

<?php include __DIR__ . '/../footer.php';
?>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>