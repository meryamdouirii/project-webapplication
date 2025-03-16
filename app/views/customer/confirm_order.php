<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="/../stylesheets/styleCart.css" rel="stylesheet">
</head>

<body>
    <?php include __DIR__ . '/../header.php'; ?>

    <main class="bg-light-blue container-fluid d-flex justify-content-center align-items-center vh-100">
    <div class="bg-blue text-center p-5 rounded d-flex align-items-center">
        <i class="fas fa-check-circle text-white me-3 fa-3x"></i>
        <div>
            <h2 class="cart-title text-white">Order confirmed</h2>
            <p style="color: aliceblue;">Please check your email for tickets</p>
        </div>
    </div>
</main>



    <?php include __DIR__ . '/../footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>