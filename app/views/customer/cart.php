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

    <main class="bg-light-blue container-fluid p-4">
        <div class="container">
            <h2 class="cart-title text-center mb-4">Shopping Cart</h2>
            <div class="row">
                <div class="col-md-8">
                    <section class="cart-items">
                        <?php
                        if (!empty($_SESSION['cart'])) {
                            $totalPrice = 0;
                            foreach ($_SESSION['cart'] as $index => $item) {
                                $eventName = htmlspecialchars($item['event_name']);
                                $eventLocation = htmlspecialchars($item['event_location']);
                                $eventTime = htmlspecialchars($item['event_time']);
                                $eventDuration = htmlspecialchars($item['event_duration']);
                                $eventPrice = floatval($item['event_price']);
                                $quantity = intval($item['quantity']);
                                $subtotal = $eventPrice * $quantity;
                                $totalPrice += $subtotal;
                                ?>
                                <div class="cart-item row align-items-center">
                                    <div class="col-md-2">
                                        <img src="/images/event-placeholder.jpg" alt="Event Image">
                                    </div>
                                    <div class="col-md-6 cart-details">
                                        <h5><?= $eventName; ?></h5>
                                        <p class="cart-info"><i class="bi bi-clock"></i> <?= $eventTime; ?> -
                                            <?= gmdate("H:i", $eventDuration * 60); ?>
                                        </p>
                                        <p class="cart-info"><i class="bi bi-geo-alt"></i> <?= $eventLocation; ?></p>
                                        <span class="stock-status">In stock</span>
                                    </div>
                                    <div class="col-md-4 cart-actions text-end">
                                        <p class="fw-bold">€<?= number_format($eventPrice, 2, ',', '.'); ?></p>
                                        <div class="d-inline-flex align-items-center">
                                            <button class="btn btn-light"
                                                onclick="updateQuantity(<?= $index; ?>, -1)">-</button>
                                            <input type="number" class="form-control mx-2" id="quantity-<?= $index; ?>"
                                                value="<?= $quantity; ?>" min="1" readonly>
                                            <button class="btn btn-light" onclick="updateQuantity(<?= $index; ?>, 1)">+</button>
                                            <button class="btn btn-danger btn-sm ms-2" onclick="removeItem(<?= $index; ?>)"><i
                                                    class="bi bi-trash"> remove </i></button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <?php
                            }
                        } else {
                            echo '<div class="empty-cart-container">';
                            echo '<img src="/images-logos/emptyShoppingCart.png" alt="Empty Cart">'; // Ensure you have an image for empty cart
                            echo '<h3>Your cart is empty</h3>';
                            echo '<p>Looks like you haven\'t added anything to your cart yet.</p>';
                            echo '<a href="/dance/tickets" class="button w-50">Buy tickets</a>';
                            echo '</div>';
                        }
                        ?>
                    </section>
                </div>

                <?php if (!empty($_SESSION['cart'])): ?>
                    <!-- Show Order Summary only if cart is not empty -->
                    <div class="col-md-4">
                        <div class="card p-3">
                            <h4>Order Summary</h4>
                            <ul class="list-group mb-3">
                                <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                                    <li id="summary-item-<?= $index ?>"
                                        class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="my-0"><?= htmlspecialchars($item['event_name']); ?></h6>
                                            <small class="text-muted">
                                                <?= htmlspecialchars($item['event_location']); ?> -
                                                <?= htmlspecialchars($item['event_time']); ?>
                                                (<?= gmdate("H:i", $item['event_duration'] * 60); ?>)
                                            </small>
                                            <br>
                                            <small id="summary-quantity-<?= $index ?>" class="text-muted">Quantity:
                                                <?= intval($item['quantity']); ?></small>
                                        </div>
                                        <span id="summary-price-<?= $index ?>"
                                            class="text-muted">€<?= number_format($item['event_price'] * $item['quantity'], 2, ',', '.'); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <hr>
                            <p>
                                <strong>Total: <span class="float-end">€<span id="totalPrice">
                                            <?= number_format($totalPrice, 2, ',', '.'); ?>
                                        </span></span>
                                </strong>
                            </p>
                            <form action="/confirm_order" method="POST">
                                <button type="submit" class="button w-100">Pay with iDEAL</button>
                            </form>

                        </div>
                    </div>
                <?php else: ?>
                    <!-- Show message when cart is empty -->
                    <div class="col-md-4">
                        <div class="card p-3">
                            <h4>Order summary</h4>
                            <p>Not available</p>
                            <a href="/dance/tickets" class="button w-100">Buy tickets</a>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>

        <script>
            function updateQuantity(index, change) {
                let input = document.getElementById('quantity-' + index);
                let newQuantity = parseInt(input.value) + change;
                if (newQuantity < 1) return;

                fetch('/update_cart', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ index: index, quantity: newQuantity })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            input.value = newQuantity;
                            document.getElementById('totalPrice').innerText = data.totalPrice;
                            // Update quantity and price in the order summary
                            document.getElementById('summary-quantity-' + index).innerText = "Quantity: " + newQuantity;
                            document.getElementById('summary-price-' + index).innerText = "€" + (parseFloat(data.items[index].event_price) * newQuantity).toFixed(2).replace('.', ',');
                        }
                    });
            }

            function removeItem(index) {
                fetch('/update_cart', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ index: index, remove: true })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload(); // Refresh page to update cart
                        }
                    });
            }
        </script>
    </main>

    <?php include __DIR__ . '/../footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>