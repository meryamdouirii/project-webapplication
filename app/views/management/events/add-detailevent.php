<head>
    <title>Edit Detail Event</title>
</head>
<?php include __DIR__ . '../../../header.php'; 
use App\Services\UploadService;?>
<main class="container" style="margin-top:5%; margin-bottom:5%;">     
    <div class="d-flex justify-content-start mb-2">
        <a href="/manage-events/manage-detailevents?event_id=<?=htmlspecialchars($main_event_id)?>" class="button">Go Back</a>
    </div>
    <div class="d-flex justify-content-center align-items-center">  
        <div class="card p-4 my-5" style="width: 60%;">
            <form action="insert_detail_event.php" method="POST" enctype="multipart/form-data" class="container mt-4">
                <h3 class="card-title text-center">Add a new <?=htmlspecialchars($picked_event->name)?> event!</h3>
                <div class="mb-3">
                    <label for="name" class="form-label">Name your event</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="banner_image" class="form-label">Insert a banner image</label>
                    <input type="file" name="banner_image" id="banner_image" class="form-control"accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="banner_description" class="form-label">Insert a brief description for the banner</label>
                    <textarea name="banner_description" id="banner_description" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Insert your main content here</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image_description_1" class="form-label">Insert your first image</label>
                    <input type="file"accept="image/*"name="image_description_1" id="image_description_1" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image_description_2" class="form-label">Insert your second image</label>
                    <input type="file" accept="image/*" name="image_description_2" id="image_description_2" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="card_description" class="form-label">Insert the main content on the card</label>
                    <textarea name="card_description" id="card_description" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="card_image" class="form-label">Insert the image on the card</label>
                    <input type="file" name="card_image" id="card_image" accept="image/*" class="form-control">
                </div>
                <?php if($picked_event->id == 2) :?>
                <div class="mb-3">
                    <label for="amount_of_stars" class="form-label">Insert the amount of stars the restaurant has</label>
                    <input type="number" name="amount_of_stars" id="amount_of_stars" class="form-control" min="0" max="5">
                </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</main>
<?php include __DIR__ . '../../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
