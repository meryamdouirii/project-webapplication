<head>
    <title>Dance Event</title>
    <link href="/stylesheets/style.css" rel="stylesheet">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/../../header.php'; ?>
<main class="container-fluid p-0">
    <section class="hero-section-event text-white text-center event-hero" style="background-image: url('/images-logos/event-hero.jpg');">
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
                        <a href="#" class="btn btn-lg mt-3 event-ticket-btn button">GET TICKETS</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="info-section text-center">
        <div class="container" style="margin-top: -40px;">
            <div class="row justify-content-center style="margin-top: -40px;">
                <div class="col-md-3 bg-blue text-white p-3 m-4 position-relative event-info-box">
                    <h3 class="skiranjiHeader event-info-title">3 Days</h3>
                    <p>Three full days of electronic music from the world's best DJs</p>
                    <a href="#" class="button">VIEW SCHEDULE</a>
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
</main> 

<?php include __DIR__ . '/../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
