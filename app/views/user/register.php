<head>
    <title>Register Account</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<?php
include __DIR__ . '/../header.php';?>
<main class="container d-flex justify-content-center align-items-center vh-100" style="margin-top:5%;
    margin-bottom:5%;">     
    <div class="card p-4 my-5" style="width: 60%;">
    <h3 class="text-center">Register</h3>
    <div id="error-message" style="display: none;" class="alert alert-danger" role="alert">
        </div>
        <form method="POST" action="/register">
            <div class="card p-3 mb-3">
                <h5 class="card-title">Personal Information</h5>
                <div class="mb-3 row">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter your first name"
                        value="<?php echo isset($formData['first_name']) ? $formData['first_name'] : ''; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter your last name"
                        value="<?php echo isset($formData['last_name']) ? $formData['last_name'] : ''; ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter your phone number"
                    value="<?php echo isset($formData['phone_number']) ? $formData['phone_number'] : ''; ?>">
                </div>
            </div>
            <div class="card p-3 mb-3">
                <h5 class="card-title">Login Credentials</h5>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address*</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address" required
                    value="<?php echo isset($formData['email']) ? $formData['email'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password*</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password*</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Re-enter your password" required>
                </div>
                <div class="g-recaptcha" data-sitekey="6LdJ6NoqAAAAAPXEcAsziikYBDC83XRle2tqVGIp"></div>
            </div>
            
           
            <button type="submit" class="button">Make account</button>
        </form>
    </div>
</main>

<?php include __DIR__ . '/../footer.php';
?>    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>