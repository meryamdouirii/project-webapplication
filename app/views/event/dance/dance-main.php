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
                <h2 class="section-title">Participating DJ"S</h2>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card-artist">
                        <img src="path-to-hardwell-image.jpg" alt="Hardwell">
                        <div class="card-content">
                            <div class="genre-tags">
                                <span class="genre-tag">Dance</span>
                                <span class="genre-tag">House</span>
                            </div>
                            <h3 class="artist-name">Hardwell</h3>
                            <p>Hardwell is known for his energetic performances. Hardwell hails from Breda, Netherlands, and began DJing at the age of 14.</p>
                            
                            <div class="event-details">
                                <div class="event-details-left">
                                    <div class="event-date">25 July</div>
                                    <div class="event-location">Jopenkerk</div>
                                </div>
                                <div class="event-details-right">
                                    <div class="event-time">23:00 - 00:30</div>
                                    <div class="price">€60,00</div>
                                    <div class="tickets-available">300 tickets available</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="action-buttons">
                            <a href="#" class="button">INFO & SHOWS</a>
                            <a href="#" class="button">GET TICKETS</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 

    <?php print_r($detailEvents); ?>
    <br>
    <br>
    <?php print_r($event); ?>



    
    <section class="schedule-section">
        <div class="container">
            <h2 class="section-title">Event Schedule</h2>
            <div class="schedule-tabs">
                <button class="tab-button active" data-day="friday">Friday</button>
                <button class="tab-button" data-day="saturday">Saturday</button>
                <button class="tab-button" data-day="sunday">Sunday</button>
            </div>

            <div class="schedule-cards">
                <!-- Friday Schedule -->
                <div class="schedule-card active" id="friday">
                    <h2 class="schedule-day">Friday - 25 July</h2>
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
                            <tr>
                                <td>Nicky Romero/ Afrojack</td>
                                <td>Lichtfabriek</td>
                                <td>20:00 - 02:00</td>
                                <td>€ 75,00</td>
                                <td>1500</td>
                            </tr>
                            <tr>
                                <td>Tiësto</td>
                                <td>Slachthuis</td>
                                <td>22:00 - 23:30</td>
                                <td>€ 60,00</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td>Armin van Buuren</td>
                                <td>XO the club</td>
                                <td>22:00 - 23:30</td>
                                <td>€ 60,00</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td>Martin Garrix</td>
                                <td>Puncer comedy club</td>
                                <td>22:00 - 23:30</td>
                                <td>€ 60,00</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td>Hardwell</td>
                                <td>Jopenkerk</td>
                                <td>23:00 - 00:30</td>
                                <td>€ 60,00</td>
                                <td>300</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="all-access">*All-Access pass for Friday €125,00</p>
                    <a href="#" class="button schedule-button">GET TICKETS</a>
                </div>

                <!-- Saturday Schedule -->
                <div class="schedule-card" id="saturday">
                    <h2 class="schedule-day">Saturday - 26 July</h2>
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
                            <tr>
                                <td>Nicky Romero/ Afrojack</td>
                                <td>Lichtfabriek</td>
                                <td>20:00 - 02:00</td>
                                <td>€ 75,00</td>
                                <td>1500</td>
                            </tr>
                            <tr>
                                <td>Tiësto</td>
                                <td>Slachthuis</td>
                                <td>22:00 - 23:30</td>
                                <td>€ 60,00</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td>Armin van Buuren</td>
                                <td>XO the club</td>
                                <td>22:00 - 23:30</td>
                                <td>€ 60,00</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td>Martin Garrix</td>
                                <td>Puncer comedy club</td>
                                <td>22:00 - 23:30</td>
                                <td>€ 60,00</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td>Hardwell</td>
                                <td>Jopenkerk</td>
                                <td>23:00 - 00:30</td>
                                <td>€ 60,00</td>
                                <td>300</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="all-access">*All-Access pass for Saturday €125,00</p>
                    <a href="#" class="button schedule-button">GET TICKETS</a>
                </div>

                <!-- Sunday Schedule -->
                <div class="schedule-card" id="sunday">
                    <h2 class="schedule-day">Sunday - 27 July</h2>
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
                            <tr>
                                <td>Nicky Romero/ Afrojack</td>
                                <td>Lichtfabriek</td>
                                <td>20:00 - 02:00</td>
                                <td>€ 75,00</td>
                                <td>1500</td>
                            </tr>
                            <tr>
                                <td>Tiësto</td>
                                <td>Slachthuis</td>
                                <td>22:00 - 23:30</td>
                                <td>€ 60,00</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td>Armin van Buuren</td>
                                <td>XO the club</td>
                                <td>22:00 - 23:30</td>
                                <td>€ 60,00</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td>Martin Garrix</td>
                                <td>Puncer comedy club</td>
                                <td>22:00 - 23:30</td>
                                <td>€ 60,00</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td>Hardwell</td>
                                <td>Jopenkerk</td>
                                <td>23:00 - 00:30</td>
                                <td>€ 60,00</td>
                                <td>300</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="all-access">*All-Access pass for Sunday €125,00</p>
                    <a href="#" class="button schedule-button">GET TICKETS</a>
                </div>
            </div>
        </div>
    </section>
</main> 

<?php include __DIR__ . '/../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Voeg dit toe aan je pagina voor de tab functionaliteit
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-button');
    const cards = document.querySelectorAll('.schedule-card');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active class from all tabs and cards
            tabs.forEach(t => t.classList.remove('active'));
            cards.forEach(c => c.classList.remove('active'));

            // Add active class to clicked tab and corresponding card
            tab.classList.add('active');
            document.getElementById(tab.dataset.day).classList.add('active');
        });
    });
});
</script>
</body>
