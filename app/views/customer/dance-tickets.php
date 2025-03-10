<head>
    <title>Dance Event</title>
    <link href="/../stylesheets/styleTickets.css" rel="stylesheet">
</head>
<?php include __DIR__ . '/../header.php'; ?>
<!-- <pre> <?php print_r($sessionsByDate) ?></pre> -->
<main class="bg-light-blue container-fluid p-0">

    <div class="bg-blue ticket-title-section" style="padding: 50px 0;">
        <h2 class="ticket-title" style="color: #FF1493;">Dance festival Tickets</h2>
        <p>Join us for three days of amazing electronic music</p>
    </div>

    <section class="tickets-section">
        <div class="container">
            <div class="tickets-tabs">
                <?php foreach ($sessionsByDate as $date => $sessions): ?>
                    <button class="tab-button <?= $date === '25 July' ? 'active' : '' ?>">
                        <?= $date ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <?php foreach ($sessionsByDate as $date => $sessions): ?>
                <div class="day-sessions <?= $date === '25 July' ? 'active' : '' ?>">
                    <?php foreach ($sessions as $session): ?>
                        <div class="session-card">
                            <div class="artist-info">
                                <h3 class="artist-name"><?= htmlspecialchars($session->getDetailEventName()) ?></h3>
                                <span class="session-type"><?= strtoupper($session->getName())?> </span>
                            </div>

                            <div class="session-details">
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?= htmlspecialchars($session->getLocation()) ?>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-clock"></i>
                                    <?= date('H:i', strtotime($session->getDatetimeStart())) ?>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-hourglass-half"></i>
                                    <?= $session->getDurationMinutes() ?> minutes
                                </div>
                            </div>

                            <!-- Add item(session) to card form -->
                            <form method="POST" action="/addToCart">
                                <input type="hidden" name="session_id" value="<?= $session->getId() ?>">
                                <input type="hidden" name="event_name"
                                    value="<?= htmlspecialchars($session->getDetailEventName()) ?>">
                                <input type="hidden" name="event_location"
                                    value="<?= htmlspecialchars($session->getLocation()) ?>">
                                <input type="hidden" name="event_time"
                                    value="<?= date('H:i', strtotime($session->getDatetimeStart())) ?>">
                                <input type="hidden" name="event_duration" value="<?= $session->getDurationMinutes() ?>">
                                <input type="hidden" name="event_price" value="<?= $session->getPrice() ?>">

                                <div class="ticket-controls">
                                    <div class="quantity-selector">
                                        <button type="button" class="quantity-btn" onclick="decreaseQuantity(this)">-</button>
                                        <input type="number" name="quantity" class="quantity-input" value="1" min="1">
                                        <button type="button" class="quantity-btn" onclick="increaseQuantity(this)">+</button>
                                    </div>
                                    <button type="submit" class="add-to-cart-btn">
                                        <i class="fas fa-shopping-cart"></i> Add to Cart
                                    </button>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabButtons = document.querySelectorAll('.tab-button');
            const daySessions = document.querySelectorAll('.day-sessions');

            tabButtons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    tabButtons.forEach((btn) => btn.classList.remove('active'));
                    daySessions.forEach((session) => session.classList.remove('active'));

                    button.classList.add('active');
                    daySessions[index].classList.add('active');
                });
            });
        });

        function decreaseQuantity(button) {
            let input = button.nextElementSibling;
            if (input.value > 1) {
                input.value--;
            }
        }

        function increaseQuantity(button) {
            let input = button.previousElementSibling;
            input.value++;
        }
    </script>

</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>

</html>