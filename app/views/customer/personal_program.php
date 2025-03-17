<head>
    <title>Dance Event</title>
    <link href="/../stylesheets/styleTickets.css" rel="stylesheet">
</head>
<style>
    .order-card {
        background-color: white;
        color: black;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .ticket-item {
        background-color: rgb(208, 207, 207);
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }
</style>
<?php include __DIR__ . '/../header.php'; ?>
<div class="bg-blue ticket-title-section" style="padding: 50px 0;">
    <h2 class="ticket-title" style="color: #FF1493;">My Festival Tickets</h2>
    <p>personal program</p>
</div>

<main class="bg-light-blue container-fluid p-5">
    <div class="container">
        <?php if (empty($orders)): ?>
            <div class="d-flex flex-column align-items-center justify-content-center vh-25">
        <p class="text-center">You have no orders yet.</p>
        <a href="/dance/tickets" class="button">Buy tickets</a>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-card">
                    <h3>Order ID: <?= htmlspecialchars($order->getId()) ?></h3>
                    <p><strong>Order Date:</strong> <?= htmlspecialchars($order->getOrderDate()) ?></p>
                    <h4>Tickets:</h4>
                    <div class="row">
                        <?php foreach ($order->getTickets() as $ticket): ?>
                            <div class="col-md-12 ticket-item d-flex">
                                <div>
                                    <strong>Event:</strong> <?= htmlspecialchars($ticket->getSession()['event_name']) ?><br>
                                    <strong>Artist/Restaurant:</strong>
                                    <?= htmlspecialchars($ticket->getSession()['artist_or_restaurant_name']) ?><br>
                                    <strong>Session:</strong> <?= htmlspecialchars($ticket->getSession()['session_name']) ?><br>
                                    <strong>Location:</strong> <?= htmlspecialchars($ticket->getSession()['location']) ?><br>
                                    <strong>Date & Time:</strong>
                                    <?= htmlspecialchars($ticket->getSession()['datetime_start']) ?><br>
                                    <strong>Price:</strong> €<?= number_format($ticket->getSession()['ticket_price'], 2) ?><br>
                                    <!-- <strong>Barcode:</strong> <?= htmlspecialchars($ticket->getbarCode()) ?><br> -->
                                    <a href="#" class="button">View Barcode</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</main>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>

</html>