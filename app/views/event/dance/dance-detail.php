<head>
    <title>Dance Event</title>
</head>
<?php include __DIR__ . '/../../header.php'; ?>
<main class="bg-light-blue container-fluid p-0">


    <section class="hero-section-event text-white text-center event-hero"
        style="background-image: url('<?= $detailEvent->getBannerImage() ?>');">
        <div class="overlay event-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 text-start bg-blue-transparent p-3 position-relative event-artist-list">
                        <h1 class="event-title"><?php echo $detailEvent->getName(); ?></h1>
                        <ul class="list-unstyled my-3">
                            <p><?php echo $detailEvent->getBannerDescription(); ?></p>
                        </ul>
                        <a href="#" class="btn btn-lg mt-3 event-ticket-btn button">GET TICKETS</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container-xl py-5">

        <section class="about-artist-section my-5 px-5">
            <h2 class="section-title">About <?= $detailEvent->getName() ?></h2>
            <div class="artist-content">
                <div class="row">
                    <div class="col-md-8">
                        <p class="artist-description"><?= $detailEvent->getDescription() ?></p>
                    </div>
                    <div class="col-md-4">
                        <img src="<?= $detailEvent->getImageDescription1() ?: '/images-logos/default.jpg' ?>"
                            alt="<?= $detailEvent->getName() ?>" class="img-fluid artist-image">
                    </div>
                </div>
            </div>
        </section>

        <section class="schedule-section my-5">
            <h2 class="section-title">When can I see <?= $detailEvent->getName() ?>?</h2>
            <div class="sessions-grid">
                <?php foreach ($detailEvent->getSessions() as $session): ?>
                    <div class="session-card" style="background-color: #17295B;">
                        <div class="session-date"><?= date('d M', strtotime($session->getDatetimeStart())) ?></div>
                        <div class="session-info">
                            <h3 class="session-name"><?= $session->getName() ?></h3>
                            <p class="session-location"><?= $session->getLocation() ?></p>
                            <p class="session-time"><?= date('H:i', strtotime($session->getDatetimeStart())) ?></p>
                            <p class="session-duration"><?= $session->getDurationMinutes() ?> minutes</p>
                            <div class="session-price">€<?= number_format($session->getPrice(), 2) ?></div>
                            <div class="tickets-left"><?= $session->getTicketLimit() ?> tickets available</div>
                        </div>
                        <a href="/dance/tickets" class="button session-button">GET TICKETS</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <h2 class="section-title">SONGS YOU MIGHT KNOW</h2>
        <section class="songs-section my-5">
            <div class="songs-container">
                <?php foreach ($detailEvent->getSongs() as $song): ?>
                    <div class="song-card">
                        <img src="<?= $song->getPhoto() ?: '/images-logos/default.jpg' ?>" class="song-image">
                        <div class="song-content">
                            <h3 class="song-title"><?= $song->getTitle() ?></h3>
                            <p class="song-description"><?= $song->getDescription() ?></p>
                            <div class="audio-wave"></div>
                        </div>
                        <a href="/dance/tickets" class="get-tickets-btn">GET TICKETS</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

    </div> <!-- End of the container -->
</main>


<?php include __DIR__ . '/../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>