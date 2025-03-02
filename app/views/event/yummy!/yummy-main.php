<head>
    <title>Yummy! Event</title>
</head>
<?php include __DIR__ . '/../../header.php'; ?>
<main class="container-fluid p-0">
    <section class="hero-section-event text-white text-center event-hero" style="background-image: url('/images-logos/yummy!-event-hero.png');">
        <div class="overlay event-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mt-4 text-start bg-blue-transparent p-3 position-relative event-artist-list">
                        <h1 class="event-title">YUMMY!</h1>
                        <ul class="list-unstyled">
                            <li>Café de Roemer</li>
                            <li>Ratatouille</li>
                            <li>Urban Frenchy Bistro Toujours</li>
                            <li>Restaurant Fris</li>
                        </ul>
                        <a href="#" class="btn btn-lg mt-3 event-ticket-btn button">GET TICKETS</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="card-list-section">
        <div class="container" style="margin-top: -40px;">
            <div class="row justify-content-center style="margin-top: -40px;">
            <?php foreach ($detailEvents as $detailEvent): ?>
                <div class="col-md-3 bg-blue text-white p-3 m-4 position-relative event-info-box">
                    <h3 class="skiranjiHeader event-info-title"><?= htmlspecialchars($detailEvent->name); ?></h3>
                    <h2 class="stars">
                        <?php   $amountOfStars = $detailEvent->amount_of_stars ?? 0;
                                $fullStars = str_repeat('&#9733;',$amountOfStars);
                                $emptyStars = str_repeat('&#9734;',5-$amountOfStars);
                                echo $fullStars . $emptyStars;
                        ?>      
                    </h2>
                    <?php if ($detailEvent->card_image): ?>
                        <img class="h-auto w-100 event-info-image" src="data:image/jpeg;base64,<?= base64_encode($detailEvent->card_image); ?>" alt="Restaurant Image" ></img>	
                    <?php endif; ?>
                    <div class="tags mt-1">
                    <?php foreach ($detailEvent->tags as $tag): ?>
                        <span class="small-tag bg-transparent text-white border border-white px-3 py-1 mt-1 mx-1 d-inline-block"><?= htmlspecialchars($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <p class="mt-2">
                    <?= htmlspecialchars($detailEvent->card_description ?? ''); ?>
                    </p>
                        <a href="#" class="button">MORE</a>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </section>
</main> 

<?php include __DIR__ . '/../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
