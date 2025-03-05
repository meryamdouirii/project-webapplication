
<?php include __DIR__ . '/../../header.php'; 
use App\Models\DetailEvent;
use App\Models\Session;
?>
<head>
    <title>Yummy! - <?= htmlspecialchars($detailYummyEvent->getName())?></title>
</head>
<main class="bg-light-blue container-fluid p-0">
    <section class="hero-section-event text-white text-center event-hero" style="background-image: url('<?= htmlspecialchars($detailYummyEvent->getBannerImage() ?: '/images-logos/default.jpg') ?>');">
        <div class="overlay event-overlay">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-md-3 d-flex flex-column align-items-center justify-content-center mt-4 text-start bg-blue-transparent p-3 position-relative event-artist-list">
                        <h1 class="event-title">YUMMY!</h1>
                        <h2 class="mt-5 mb-5 text-center"><?=htmlspecialchars($detailYummyEvent->getBannerDescription())?></h2>
                        <a href="#" class="btn btn-lg mt-3 event-ticket-btn button">GET TICKETS</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light-blue card-list-section pb-5">
        <div class="container" style="margin-top: -40px;">
                <div class="bg-blue text-white p-3 m-4 position-relative">
                    <h1 class="event-about-title">About <?=htmlspecialchars($detailYummyEvent->getName())?></h1>
                    <h1 class="stars mt-2 mb-2 text-center"> <?php
                            $amountOfStars = $detailYummyEvent->getAmountOfStars() ?? 0;
                            $fullStars = str_repeat('&#9733;', $amountOfStars);
                            $emptyStars = str_repeat('&#9734;', 5 - $amountOfStars);
                            echo $fullStars . $emptyStars;
                        ?></h1>
                    <div class="row mt-2">
                        <div class="col-md-6 d-flex align-items-center">
                            <p>
                                <?=htmlspecialchars($detailYummyEvent->getDescription())?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <img class="h-auto w-100 event-info-image" 
                                src="<?= !empty($detailYummyEvent->getImageDescription1()) ? htmlspecialchars($detailYummyEvent->getImageDescription1()) : "/images-logos/default.jpg" ?>" 
                                alt="<?= htmlspecialchars($detailYummyEvent->getName()) ?> Image" />
                        </div>
                    </div>
                    <div class="row mt-4">
                    <div class="col-4">
                        <img class="h-auto w-100 event-info-image" 
                            src="<?= !empty($detailYummyEvent->getImageDescription2()) ? htmlspecialchars($detailYummyEvent->getImageDescription2()) : "/images-logos/default.jpg" ?>" 
                            alt="<?= htmlspecialchars($detailYummyEvent->getName()) ?> Image" />
                    </div>
                        <div class="col-2 d-flex align-items-center ">
                            <button class="button" href="#">BUY TICKETS</button>
                        </div>
                        <div class="col-6 d-flex align-items-center ">
                                <table>
                                    <tr>
                                        <th>Dates</th>
                                        <th>Session 1</th>
                                        <th>Session 2</th>
                                        <th>Session 3</th>
                                        <th>Seats</th>
                                        <th>Price 12+</th>
                                        <th>Price 12-</th>
                                    </tr>
                                    <?php
                                      $dates = [
                                        new DateTime("2025-07-24"),
                                        new DateTime("2025-07-25"),
                                        new DateTime("2025-07-26"),
                                        new DateTime("2025-07-27")
                                    ];

                            
                                       foreach ($dates as $date) {
                                        echo "<tr>
                                        <td>" . $date->format('d F') . "</td>"; 
                                        foreach ($yummySessions as $session) {
                                            $sessionDate = (new DateTime($session->getDateTimeStart()))->format('Y-m-d');
                                            if ($sessionDate == $date->format('Y-m-d')) {

                                                echo "<td>" . (new DateTime($session->getDateTimeStart()))->format('H:i') . "</td>"; 
                                               
                                            }
                                            
                                        }
                                        echo "<td>" . $session->getTicketsAvailable() . "</td>";    
                                        echo "<td>" . $session->getPrice() . "</td>";
                                        echo "<td>" . ($session->getPrice() / 2) . "</td>";
                                        echo "</tr>";
                                    }
                                    
                                        ?>

                            </table>
                        </div>
                    </div>
                    
                   
                    
                    
                </div>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

