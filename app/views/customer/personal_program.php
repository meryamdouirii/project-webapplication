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
    /* Modal background */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Modal content */
    .modal-content {
        background-color: white;
        padding: 20px;
        width: 50%;
        max-width: 500px;
        text-align: center;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 50vh; /* Adjust height */
    }

    /* Close button */
    .close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 24px;
        cursor: pointer;
    }

    /* Centered barcode */
    .barcode-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-grow: 1;
        width: 100%;
        height: 100%;
    }

    #barcode {
        max-width: 100%;
        height: auto;
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
                                    <a href="#" class="button view-barcode" data-barcode="<?= htmlspecialchars($ticket->getBarCode()) ?>">View Barcode</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div id="barcodeModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h3>Ticket Barcode</h3>
                                <svg id="barcode"></svg>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</main>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("barcodeModal");
        const barcodeElement = document.getElementById("barcode");
        const closeBtn = document.querySelector(".close");

        document.querySelectorAll(".view-barcode").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                const barcodeValue = this.getAttribute("data-barcode");

                // Generate Barcode
                JsBarcode(barcodeElement, barcodeValue, {
                    format: "CODE128",
                    displayValue: true
                });

                // Show Modal
                modal.style.display = "flex";
            });
        });

        // Close Modal
        closeBtn.addEventListener("click", function() {
            modal.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    });
</script>
<?php include __DIR__ . '/../footer.php'; ?>
