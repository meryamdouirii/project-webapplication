<?php
include __DIR__ . '/../header.php';
?>
<main class="container d-flex justify-content-center align-items-center vh-100">     
    <div class="card p-4 my-5" style="width: 35%;">
        <h3 class="text-center">Reset Password</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter your new password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="button">Reset Password</button>
        </form>
    </div>
</main>

<?php include __DIR__ . '/../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
