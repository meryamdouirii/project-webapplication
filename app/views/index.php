<head>
    <title>The Haarlem Festival</title>
</head>
<?php include __DIR__ . '/header.php'; ?>
<main>
    <!-- <pre> <?php print_r($homepage) ?></pre> -->
    <section class="hero">
        <div class="hero-overlay">
            <div>
                <h1 class="skiranjiHeader"><?= htmlspecialchars($homepage->name); ?></h1>
                <p><?= htmlspecialchars($homepage->banner_description); ?></p>
                <a href="#" class="button">DISCOVER OUR EVENTS</a>
                <a href="#" class="button">GET TICKETS</a>
            </div>
        </div>
    </section>

    <!-- <pre><?php print_r($events); ?></pre> -->

    <section class="bg-blue py-5">
        <div class="container">
            <div class="row justify-content-center">
                <?php foreach ($events as $event): ?>
                    <div class="col-md-5">
                        <a href="#" class="card">
                            <img src="<?= htmlspecialchars($event->picture_homepage ?? 'default.jpg'); ?>"
                                alt="<?= htmlspecialchars($event->name); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($event->name); ?></h5>
                                <p><?= htmlspecialchars($event->description_homepage); ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <section class="bg-white py-5">
        <div class="container">
            <div class="row text-center justify-content-center ">
                <div class="col-md-4">
                    <div class="icon-circle mb-3">
                        <img src=/images-logos/calendar-icon.png alt="Calendar Icon" class="icon-img">
                        <div class="card-body">
                            <h5 class="card-title">July 24-27, 2025</h5>
                            <p>Four days of unforgettable experiences.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="icon-circle mb-3">
                        <img src="/images-logos/location-icon.png" alt="Location Icon" class="icon-img">
                        <div class="card-body">
                            <h5 class="card-title">Historic Haarlem</h5>
                            <p>Multiple venues across the city center.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="icon-circle mb-3">
                        <img src="/images-logos/music-icon.png" alt="Music Icon" class="icon-img">
                        <div class="card-body">
                            <h5 class="card-title">Diverse performances</h5>
                            <p>Dance the night away with DJs</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="bg-blue py-5">
        <h2 class="skiranjiHeader"> Vistit us here!</h2>
        <div class="map-responsive">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d77928.45010574868!2d4.560478375396664!3d52.383763152454236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5ef6c60e1e9fb%3A0x8ae15680b8a17e39!2sHaarlem!5e0!3m2!1snl!2snl!4v1739461139708!5m2!1snl!2snl"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section class="bg-pink py-5 stayUpdated">
        <div class="container justify-content-center text-center">
            <h2> Stay Updated</h2>
            <p>Subscribe to our newsletter and stay up to date with the latest news and offers from The Haarlem Festival
            </p>
            <form action="#" method="post">
                <div class="input-group" style="width: 40%;">
                    <input type="email" class="form-control" placeholder="Enter your E-mail" style="width: 200px;">
                    <button class="button" type="submit">Subscribe</button>
                </div>

            </form>
        </div>
    </section>


</main>
<?php include __DIR__ . '/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>