<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/style.css" rel="stylesheet">
</head>


<body>
<?php include 'header.php'; ?>
<main>
    <section class="hero">
        <div class="hero-overlay">
            <div>
                <h1>The Festival</h1>
                <p>Join us for three days of music, food, and unforgettable memories</p>
                <a href="#" class="button">Discover our events</a>
            </div>
        </div>
    </section>

    <section class="bg-blue py-5">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=500" alt="Food">
                    <div class="card-body">
                        <h5 class="card-title">Yummy</h5>
                        <p>Savor delicious cuisines from around the world.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=500" alt="Dance">
                    <div class="card-body">
                        <h5 class="card-title">Dance</h5>
                        <p>Dance the night away with amazing DJs.</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="bg-white py-5" >
    <div class="container">
        <div class="row text-center justify-content-center ">
            <div class="col-md-4">
                <div class="icon-circle mb-3">
                    <img src="calendar-icon" alt="Calendar Icon" class="icon-img">
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


</main>
<?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>