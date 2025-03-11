
<?php include __DIR__ . '/../../header.php'; 
use App\Models\DetailEvent;
use App\Models\Session;
?>
<head>
    <title>Yummy! - <?= htmlspecialchars($detailYummyEvent->getName())?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<main class="bg-light-blue container-fluid p-0">
    <section class="hero-section-event text-white text-center event-hero" style="background-image: url('<?= htmlspecialchars($detailYummyEvent->getBannerImage() ?: '/images-logos/default.jpg') ?>');">
        <button class="btn btn-primary mt-3 position-absolute top-0 start-0 m-3" onclick="openEditor('<?= htmlspecialchars($detailYummyEvent->getBannerImage() ?: '/images-logos/default.jpg') ?>', 'banner_image', '<?=$detailYummyEvent->getId()?>')"><i class="fas fa-edit"></i> Edit Content</button>
        <div class="overlay event-overlay">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-md-3 d-flex flex-column align-items-center justify-content-center mt-4 text-start bg-blue-transparent p-3 position-relative event-artist-list">
                        <h1 class="event-title">YUMMY!</h1>
                        <h2 class="mb-5 text-center">
                        <button class="btn btn-primary mt-4 position-absolute top-0 end-0 m-3" onclick="openEditor('<?= htmlspecialchars($detailYummyEvent->getBannerDescription() ?: '') ?>', 'banner_description', '<?=$detailYummyEvent->getId()?>')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <?=htmlspecialchars($detailYummyEvent->getBannerDescription())?>
                        </h2>
                        <a href="#" class="btn btn-lg mt-3 event-ticket-btn button">GET TICKETS</a>
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
                            About <?= htmlspecialchars($detailYummyEvent->getName()) ?>
                        </h1>
                        <button style="margin-top:-2rem;"class="btn btn-primary position-absolute end-0" 
                            onclick="openEditor('<?= htmlspecialchars($detailYummyEvent->getName() ?: '') ?>', 'name', '<?=$detailYummyEvent->getId()?>')">
                            <i class="fas fa-edit"></i>
                        </button>
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
                        <button class="btn btn-primary" style="margin-top:-2rem;"	 
                                onclick='openEditor("<?=$fullStars?>", "amount_of_stars", "<?=$detailYummyEvent->getId()?>")'> <i class="fas fa-edit"></i>
                        </button>
                    </h1>
                    <div class="row mt-2">
                        <div class="col-md-6 d-flex align-items-center">
                            <p>
                                <?=html_entity_decode(htmlspecialchars($detailYummyEvent->getDescription()), ENT_QUOTES | ENT_HTML5, 'UTF-8')?>
                            </p>   
                            <button class="btn btn-primary" 
                                    onclick='openEditor(<?= json_encode($detailYummyEvent->getDescription() ?: "") ?>, "description", "<?=$detailYummyEvent->getId()?>")'>
                                    <i class="fas fa-edit"></i>
                            </button>   
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <img class="h-auto w-100 event-info-image" 
                                src="<?= !empty($detailYummyEvent->getImageDescription1()) ? htmlspecialchars($detailYummyEvent->getImageDescription1()) : "/images-logos/default.jpg" ?>" 
                                alt="<?= htmlspecialchars($detailYummyEvent->getName()) ?> Image" />
                            <button class="btn btn-primary" onclick="openEditor('<?= htmlspecialchars($detailYummyEvent->getImageDescription1() ?: '/images-logos/default.jpg') ?>', 'image_description_1', '<?=$detailYummyEvent->getId()?>')"><i class="fas fa-edit"></i></button>
                        </div>
                    </div>
                    <div class="row mt-4">
                    <div class="col-4 d-flex align-items-center">
                        <img class="h-auto w-100 event-info-image" 
                            src="<?= !empty($detailYummyEvent->getImageDescription2()) ? htmlspecialchars($detailYummyEvent->getImageDescription2()) : "/images-logos/default.jpg" ?>" 
                            alt="<?= htmlspecialchars($detailYummyEvent->getName()) ?> Image" />
                            <button class="btn btn-primary" onclick="openEditor('<?= htmlspecialchars($detailYummyEvent->getImageDescription2() ?: '/images-logos/default.jpg') ?>', 'image_description_2', '<?=$detailYummyEvent->getId()?>')"><i class="fas fa-edit"></i></button>
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
    <div class="modal" id="editorModal" tabindex="-1" aria-labelledby="editorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editorModalLabel">Edit Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                <input type="hidden" name="id" id="id" value="">
                <input type="hidden" name="updateType" id="updateType" value="">
                <textarea name="content" id="editor"></textarea>
                <br>
                <div id="error-message" style="display: none;" class="alert alert-danger" role="alert"></div>
                <button type="submit" class="btn btn-success mt-3">Save Content</button>
                </form>
            </div>
            </div>
        </div>
    </div>
<script>
    let editorInstance=null;
    function openEditor(input, type, id) {
        const modal = new bootstrap.Modal(document.getElementById('editorModal'));
        modal.show();
        if (editorInstance) {

        editorInstance.destroy()
                .then(() => {
                    editorInstance = null; 
                    initializeEditor(input, type,id); 
                });
        } else {
            initializeEditor(input, type,id);
        }
    }
    function initializeEditor(input, type,id) {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '/manageDetailEvent/uploadImage'
                }
            })
            .then(editor => {
                let $editorContent = input;
                if (isImageUrl(input)) {
                    $editorContent = `<img src="${input}" alt="${type}" />`;
                }
                editor.setData($editorContent);
                document.getElementById('id').value = id;
                document.getElementById('updateType').value = type;
                editorInstance = editor;
            })
            .catch(error => {
                console.error(error);
            });
    }
    function isImageUrl(url) {
    const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
    const ext = url.split('.').pop().toLowerCase();
    return imageExtensions.includes(ext);
    }
    </script>
</main>

<?php include __DIR__ . '/../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

