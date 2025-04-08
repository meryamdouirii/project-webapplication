
<?php include __DIR__ . '/../../header.php'; 
use App\Models\DetailEvent;
use App\Models\Session;
?>
<head>
    <title>Yummy! - <?= $detailYummyEvent->getName()?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<main class="bg-light-blue container-fluid p-0">
    <section class="hero-section-event text-white text-center event-hero" style="background-image: url('<?= $detailYummyEvent->getBannerImage() ?: '/images-logos/default.jpg' ?>');">
        <div class="overlay event-overlay">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-md-3 d-flex flex-column align-items-center justify-content-center mt-4 text-start bg-blue-transparent p-3 position-relative event-artist-list">
                        <h1 class="event-title">YUMMY!</h1>
                        <h2 class="mb-5 text-center">
                        <?=$detailYummyEvent->getBannerDescription()?>
                        </h2>
                        <a href="/yummy/tickets" class="btn btn-lg mt-3 event-ticket-btn button">GET TICKETS</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="bg-light-blue card-list-section pb-5">
        <div class="container" style="margin-top: -40px;">
            <div class="bg-blue text-white p-3 m-4 position-relative">
                <div class="row align-items-center text-center position-relative">
                    <div class="col-12">
                        <h1 class="event-about-title d-inline-block">
                            About <?= $detailYummyEvent->getName() ?>
                        </h1>
                    </div>
                </div>

                    
                    <h1 class="stars mt-2 mb-2 text-center"> <?php
                            $amountOfStars = $detailYummyEvent->getAmountOfStars() ?? 0;
                            if ($amountOfStars > 5) {
                                $amountOfStars = 5;
                            }
                            $fullStars = str_repeat('&#9733;', $amountOfStars);
                            $emptyStars = str_repeat('&#9734;', 5 - $amountOfStars);
                            echo $fullStars . $emptyStars;
                        ?>
                    </h1>
                    <div class="row mt-2">
                        <div class="col-md-6 d-flex align-items-center">
                            <p>
                                <?=html_entity_decode($detailYummyEvent->getDescription(), ENT_QUOTES | ENT_HTML5, 'UTF-8')?>
                            </p>      
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <img class="h-auto w-100 event-info-image" 
                                src="<?= !empty($detailYummyEvent->getImageDescription1()) ? $detailYummyEvent->getImageDescription1() : "/images-logos/default.jpg" ?>" 
                                alt="<?= $detailYummyEvent->getName() ?> Image" />
                        </div>
                    </div>
                    <div class="row mt-4">
                    <div class="col-4 d-flex align-items-center">
                        <img class="h-auto w-100 event-info-image" 
                            src="<?= !empty($detailYummyEvent->getImageDescription2()) ? $detailYummyEvent->getImageDescription2() : "/images-logos/default.jpg" ?>" 
                            alt="<?= $detailYummyEvent->getName() ?> Image" />
                    </div>
                        <div class="col-2 d-flex align-items-center ">
                            <button class="button" href="/yummy/tickets">BUY TICKETS</button>
                        </div>
                        <?php if ($yummySessions != null): ?>
                        <div class="col-6 d-flex align-items-center ">
                                <table>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Seats</th>
                                        <th>Price 12+</th>
                                        <th>Price 12-</th>
                                    </tr>
                                    <?php foreach ($yummySessions as $session): ?><?php
                                     {
                                        echo "<td>" . $session->getDate() . "</td>";
                                        echo "<td>" . $session->getStartTime() . "</td>";
                                        echo "<td>" . $session->getTicketsAvailable() . "</td>";    
                                        echo "<td>" . $session->getPrice() . "</td>";
                                        echo "<td>" . ($session->getPrice() / 2) . "</td>";
                                        echo "</tr>";
                                    }
                                     ?><?php endforeach; ?>

                            </table>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

</main>

<?php include __DIR__ . '/../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

