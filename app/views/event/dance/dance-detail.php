<head>
    <title>Dance Event</title>
</head>
<?php include __DIR__ . '/../../header.php'; ?>
<main class="bg-light-blue container-fluid p-0">
    <section class="hero-section-event text-white text-center event-hero"
        style="background-image: url('/images-logos/default.jpg');">
        <div class="overlay event-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 text-start bg-blue-transparent p-3 position-relative event-artist-list">
                    <h1 class="event-title"><?php echo htmlspecialchars($detailEvent->getName()); ?></h1>
                        <ul class="list-unstyled">
                            <p>
                            <?php echo htmlspecialchars($detailEvent->getBannerDescription()); ?>
                            </p>
                        </ul>
                        <a href="#" class="btn btn-lg mt-3 event-ticket-btn button">GET TICKETS</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-artist-section">
    <p></p>
    </section>

    <pre><?php print_r($detailEvent); ?></pre>

</main>

<?php include __DIR__ . '/../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>