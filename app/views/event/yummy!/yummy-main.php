<head>
    <title>Yummy! Event</title>
</head>
<?php include __DIR__ . '/../../header.php'; ?>
<main class="container-fluid p-0 mb-5">
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
            <div class="row justify-content-center" style="margin-top: -40px;">
            <?php foreach ($detailEvents as $detailEvent): ?>
                <div class="col-md-3 bg-blue text-white p-3 m-4 position-relative event-info-box">
                    <h3 class="skiranjiHeader event-info-title"><?= htmlspecialchars($detailEvent->getName()); ?></h3>
                    <h2 class="stars">
                        <?php
                             $amountOfStars = $detailEvent->getAmountOfStars() ?? 0;
                             if ($amountOfStars > 5) {
                                 $amountOfStars = 5;
                             }
                             $fullStars = str_repeat('&#9733;', $amountOfStars);
                             $emptyStars = str_repeat('&#9734;', 5 - $amountOfStars);
                             echo $fullStars . $emptyStars;
                        ?>
                        <button class="btn btn-primary" style="margin-top:-2rem;"	 
                                onclick='openEditor("<?=$fullStars?>", "amount_of_stars", "<?=$detailEvent->getId()?>")'> <i class="fas fa-edit"></i>
                        </button>
                    </h2>
                    <?php if ($detailEvent->getCardImage()): ?>
                        <img class="h-auto w-100 event-info-image mt-2" src="<?= htmlspecialchars($detailEvent->getCardImage());?>" alt="<?=$detailEvent->getName()?> Image" />
                        <?php else: ?>
                        <img class="h-auto w-100 event-info-image mt-2" src="/images-logos/default.jpg" alt="<?=$detailEvent->getName()?> Image" />
                    <?php endif; ?>
                    <div class="tags mt-1">
                    <?php if (!empty($detailEvent->getTags())): ?>
                        <?php foreach ($detailEvent->getTags() as $tag): ?>
                            <span class="small-tag bg-transparent text-white border border-white px-3 py-1 mt-1 mx-1 d-inline-block"><?= htmlspecialchars($tag); ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                    <p class="mt-2">
                    <?= htmlspecialchars($detailEvent->getCardDescription() ?? ''); ?>
                    </p>
                    <a href="/Yummy!/detail?id=<?= $detailEvent->getId(); ?>" class="button">MORE</a>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
        <section class="bg-blue w-75 py-5 " style="margin-top: 2.5rem;">
            <h2 class="skiranjiHeader" style="-webkit-text-stroke: 2px #17295B; margin-top: -100px;">Locations</h2>
            <div class="bg-blue text-white p-3 m-4 position-relative">
                <div class="map-responsive">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d77928.45010574868!2d4.560478375396664!3d52.383763152454236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5ef6c60e1e9fb%3A0x8ae15680b8a17e39!2sHaarlem!5e0!3m2!1snl!2snl!4v1739461139708!5m2!1snl!2snl"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
    </div>
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
</body>
