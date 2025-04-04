<head>
    <title>Edit Event</title>
</head>
<?php include __DIR__ . '../../../header.php'; 
use App\Services\UploadService;
function getImageUrl($path) {
    return $path ? "http://localhost" . $path : "";
}
$banner_image = getImageUrl($picked_event->picture_homepage);?>
<main class="container" style="margin-top:5%; margin-bottom:5%;">     
    <div class="d-flex justify-content-start mb-2">
        <a href="/manage-events/event?event_id=<?=htmlspecialchars($picked_event->id)?>" class="button">Go Back</a>
    </div>
    <div class="d-flex justify-content-center align-items-center">  
        <div class="card p-4 my-5" style="width: 60%;">
           <form method="POST" enctype="multipart/form-data" class="container mt-4">
                <input type="hidden" name="event_id" value="<?=$picked_event->id?>">
                <h1 class="card-title text-center">Edit <?=htmlspecialchars($picked_event->name)?></h1>
                
                <!-- Event Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Event Name</label>
                    <input type="text" value="<?=htmlspecialchars($picked_event->name)?>" name="name" id="name" class="form-control" required>
                </div>
                
                <!-- Event Description Homepage -->
                <div class="mb-3">
                    <label for="description_homepage" class="form-label">Description for Homepage</label>
                    <textarea name="description_homepage" id="description_homepage" class="form-control" required><?=htmlspecialchars($picked_event->description_homepage)?></textarea>
                </div>

                <!-- Banner Description -->
                <div class="mb-3">
                    <label for="banner_description" class="form-label">Banner Description</label>
                    <textarea name="banner_description" id="banner_description" class="form-control"><?=htmlspecialchars($picked_event->banner_description)?></textarea>
                </div>

                <div class="mb-3">
                    <label for="banner_image" class="form-label">Insert your image for the home page</label>
                    <textarea name="banner_image" id="banner_image" class="form-control"><?= $banner_image ? '<img src="' . htmlspecialchars($banner_image) . '">' : '' ?></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Text areas that allow full text editing
        const textareas = ["description_homepage", "banner_description"];

        textareas.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                ClassicEditor
                .create(element, {
                    removePlugins: ['MediaEmbed', 'EasyImage', 'CKFinder', 'ImageUpload'], // Remove image-related plugins
                    toolbar: ['bold', 'italic', 'underline', 'bulletedList', 'numberedList', 'blockQuote'], // Keep only essential text tools
                })
                    .catch(error => console.error(`Error initializing CKEditor for ${id}:`, error));
            }
        });

        const imageOnlyFields = ["banner_image"];

        imageOnlyFields.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                ClassicEditor
                    .create(element, {
                        toolbar: ['uploadImage'], // Only show image upload button
                        removePlugins: ['MediaEmbed', 'Table', 'List', 'CKFinder', 'Link'], // Keep 'Paragraph' to avoid errors
                        extraPlugins: ['ImageUpload'], // Ensure ImageUpload is active
                        image: {
                            toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side'],
                            upload: {
                                types: ['jpeg', 'png', 'gif', 'webp'],
                            }
                        },
                        ckfinder: {
                        uploadUrl: '/manageDetailEvent/uploadImage'
                        }
                    })
                    .then(editor => {
                        // Prevent text input
                        editor.model.document.on('change:data', () => {
                            const data = editor.getData();
                            const onlyImageRegex = /^(<figure class="image">.*<\/figure>|\s)*$/;
                            if (!onlyImageRegex.test(data)) {
                                editor.setData(''); // Reset if text is detected
                            }
                        });
                    })
                    .catch(error => console.error(`Error initializing CKEditor for ${id}:`, error));
            }
        });
    });
</script>
<?php include __DIR__ . '../../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
