<head>
    <title>Dance Event</title>
    <link href="/stylesheets/style.css" rel="stylesheet">
    <link href="/stylesheets/styleCard.css" rel="stylesheet">
    <link href="/stylesheets/StyleSchedule.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include __DIR__ . '/../../header.php'; ?>
    <main class="bg-light-blue container-fluid p-0">
        <section class="hero-section-event text-white text-center event-hero"
            style="background-image: url('/images-logos/event-hero.jpg');">
            <div class="overlay event-overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 text-start bg-blue-transparent p-3 position-relative event-artist-list">
                            <h1 class="event-title">DANCE</h1>
                            <ul class="list-unstyled">
                                <li>Martin Garrixxx</li>
                                <li>Hardwell</li>
                                <li>Armin van Buuren</li>
                                <li>Tiesto</li>
                                <li>Afrojack</li>
                                <li>Nicky Romero</li>
                            </ul>
                            <a href="/dance/tickets" class="btn btn-lg mt-3 event-ticket-btn button">GET TICKETS</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="info-section text-center">
            <div class="container" style="margin-top: -40px;">
                <div class="row justify-content-center style=" margin-top: -40px;">
                    <div class="col-md-3 bg-blue text-white p-3 m-4 position-relative event-info-box">
                        <h3 class="skiranjiHeader event-info-title">3 Days</h3>
                        <p>Three full days of electronic music from the world's best DJs</p>
                        <a href="#" class="button overlap-button" style="width: 100%;">VIEW SCHEDULE</a>
                    </div>
                    <div class="col-md-3 bg-blue text-white p-3 m-4 position-relative event-info-box">
                        <h3 class="skiranjiHeader event-info-title">6 Big Artists</h3>
                        <p>Experience the ultimate electronic music festival where world-class DJs unite</p>
                    </div>
                    <div class="col-md-3 bg-blue text-white p-3 m-4 position-relative event-info-box">
                        <h3 class="skiranjiHeader event-info-title">6+ Genres</h3>
                        <p>Multiple genres with different music styles to suit every taste</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="artist-section">
            <div class="container">
                <div class="section-title-container">
                    <h2 class="section-title">Participating DJ'S</h2>
                </div>
                <div class="row">
                    <?php foreach ($detailEvents as $event): ?>
                        <div class="col-md-4">
                            <div class="card-artist">
                            <img src="<?php echo $event->getCardImage() ?: '/images-logos/default.jpg'; ?>" alt="<?php echo $event->getName(); ?>">
                                <div class="card-content">
                                    <div class="genre-tags">
                                        <?php foreach ($event->getTags() as $tag): ?>
                                            <span class="genre-tag"><?php echo $tag; ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                    <h3 class="artist-name"><?php echo $event->getName(); ?></h3>
                                    <!-- <p class="artist-description"><?php echo $event->getCardDescription(); ?></p> -->
                                    <div class="artist-description"><?php echo $event->getCardDescription(); ?></div>

                                    <!-- Dynamically display session details -->
                                    <?php foreach ($event->getSessions() as $session): ?>
                                        <div class="event-details">
                                            <div class="event-details-left">
                                                <div class="event-date">
                                                    <?php echo $session->getDate(); ?>
                                                </div>
                                                <div class="event-location">
                                                    <?php echo $session->getLocation(); ?>
                                                </div>
                                            </div>
                                            <div class="event-details-right">
                                                <div class="event-time">
                                                    <?php echo $session->getStartTime(); ?> -
                                                    <?php echo $session->getEndTime(); ?>
                                                </div>
                                                <div class="price">
                                                    €<?php echo number_format($session->getPrice(), 2, ',', '.'); ?>
                                                </div>
                                                <div class="tickets-available">
                                                    <?php echo $session->getTicketsAvailable(); ?> tickets available
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="action-buttons">
                                    <a href="/Dance/detail?id=<?= $event->getId(); ?>" class="button">INFO & SHOWS</a>
                                    <a href="/dance/tickets" class="button">GET TICKETS</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- <pre><?php print_r($detailEvents); ?></pre> -->
        <!-- <pre><?php echo $eventDance->name; ?></pre> --> 


        <?php
        $eventDays = ["25 July" => "friday", "26 July" => "saturday", "27 July" => "sunday"];
        ?>

        <section class="schedule-section">
            <div class="container">
                <h2 class="section-title">Event Schedule</h2>
                <div class="schedule-tabs">
                    <?php foreach ($eventDays as $date => $day): ?>
                        <button class="tab-button <?= $day === "friday" ? 'active' : '' ?>" data-day="<?= $day ?>">
                            <?= ucfirst($day) ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="schedule-cards">
                    <?php foreach ($eventDays as $date => $day): ?>
                        <div class="schedule-card <?= $day === "friday" ? 'active' : '' ?>" id="<?= $day ?>">
                            <h2 class="schedule-day"><?= ucfirst($day) ?> - <?= $date ?></h2>
                            <table class="schedule-table">
                                <thead>
                                    <tr>
                                        <th>Artist</th>
                                        <th>Location</th>
                                        <th>Time</th>
                                        <th>Price</th>
                                        <th>Tickets available</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($sessionsByDate[$date])): ?>
                                        <?php foreach ($sessionsByDate[$date] as $session): ?>
                                            <tr>
                                                <td><?= $session->getDetailEventName(); ?></td>
                                                <td><?= $session->getLocation(); ?></td>
                                                <td><?= $session->getStartTime(); ?> - <?= $session->getEndTime(); ?></td>
                                                <td>€ <?= number_format($session->getPrice(), 2, ',', '.'); ?></td>
                                                <td><?= $session->getTicketsAvailable(); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">No sessions available for this day.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <a href="/dance/tickets" class="button schedule-button">GET TICKETS</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php include __DIR__ . '/../../footer.php'; ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const tabs = document.querySelectorAll('.tab-button');
                const cards = document.querySelectorAll('.schedule-card');

                tabs.forEach(tab => {
                    tab.addEventListener('click', () => {
                        tabs.forEach(t => t.classList.remove('active'));
                        cards.forEach(c => c.classList.remove('active'));

                        tab.classList.add('active');
                        document.getElementById(tab.dataset.day).classList.add('active');
                    });
                });
            });
        </script>
</body>