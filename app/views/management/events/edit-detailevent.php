<head>
    <title>Edit Detail Event</title>
</head>
<?php include __DIR__ . '../../../header.php'; 
use App\Services\UploadService;
function getImageUrl($path) {
    return $path ? "http://localhost" . $path : "";
}
$bannerImageUrl = getImageUrl($detail_event->getBannerImage());
$imageDescription1Url = getImageUrl($detail_event->getImageDescription1());
$imageDescription2Url = getImageUrl($detail_event->getImageDescription2());
$cardImageUrl = getImageUrl($detail_event->getCardImage());?>
<main class="container" style="margin-top:5%; margin-bottom:5%;">     
    <div class="d-flex justify-content-start mb-2">
        <a href="/manage-events/manage-detailevents?event_id=<?=htmlspecialchars($detail_event->getEventId())?>" class="button">Go Back</a>
    </div>
    <div class="d-flex justify-content-center align-items-center">  
        <div class="card p-4 my-5" style="width: 60%;">
            <a href="/manage-events/delete-detailevent?detailevent_id=<?=htmlspecialchars($detail_event->getId())?>" class="btn btn-danger" style="position: absolute; top: 10px; right: 10px;" onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
            <form method="POST" enctype="multipart/form-data" class="container mt-4">
                <input type="hidden" name="detail_event_id" value="<?=$detail_event->getId()?>">
                <input type="hidden" name="main_event_id" value="<?=$detail_event->getEventId()?>">
                <h3 class="card-title text-center">Edit <?=htmlspecialchars($detail_event->getName())?></h3>
                <div class="mb-3">
                    <label for="name" class="form-label">Name your event*</label>
                    <input type="text" value="<?=htmlspecialchars($detail_event->getName())?>" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label">Add tags (max 3)</label>
                    <div class="d-flex">
                        <input type="text" id="tag_input" class="form-control" placeholder="Enter a tag" maxlength="30">
                        <button type="button" class="btn btn-primary" id="add_tag_btn">Add</button>
                    </div>
                    <div class="mt-2">
                        <ul id="tag_list" class="list-unstyled d-flex flex-wrap">
                        </ul>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="banner_image" class="form-label">Insert a banner image</label>
                    <textarea name="banner_image" id="banner_image" class="form-control"> <?= $bannerImageUrl ? '<img src="' . htmlspecialchars($bannerImageUrl) . '">' : '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="banner_description" class="form-label">Insert a brief description for the banner</label>
                    <textarea name="banner_description" id="banner_description" class="form-control"><?= $detail_event->getBannerDescription() ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Insert your main content here</label>
                    <textarea name="description" id="description" class="form-control"><?=$detail_event->getDescription()?></textarea>
                </div>
                <div class="mb-3">
                    <label for="image_description_1" class="form-label">Insert your first image</label>
                    <textarea name="image_description_1" id="image_description_1" class="form-control">  <?= $imageDescription1Url ? '<img src="' . htmlspecialchars($imageDescription1Url) . '">' : '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="image_description_2" class="form-label">Insert your second image</label>
                    <textarea name="image_description_2" id="image_description_2" class="form-control"><?= $imageDescription2Url ? '<img src="' . htmlspecialchars($imageDescription2Url) . '">' : '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="card_description" class="form-label">Insert the main content on the card</label>
                    <textarea name="card_description" id="card_description" class="form-control"><?=$detail_event->getCardDescription()?></textarea>
                </div>
                <div class="mb-3">
                    <label for="card_image" class="form-label">Insert the image on the card</label>
                    <textarea name="card_image" id="card_image" class="form-control"><?= $cardImageUrl ? '<img src="' . htmlspecialchars($cardImageUrl) . '">' : '' ?></textarea>
                </div>
                <?php if($detail_event->getEventId() == 2) :?>
                <div class="mb-3">
                    <label for="amount_of_stars" class="form-label">Insert the amount of stars the restaurant has</label>
                    <input type="number" name="amount_of_stars" id="amount_of_stars" value="<?=$detail_event->getAmountOfStars()?>" class="form-control" min="0" max="5">
                </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        
        const textareas = ["banner_description", "description", "card_description"];

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

        const imageOnlyFields = ["banner_image", "image_description_1", "image_description_2", "card_image"];

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
        let tags = [];

        // Get elements
        const tagInput = document.getElementById("tag_input");
        const addTagButton = document.getElementById("add_tag_btn");
        const tagList = document.getElementById("tag_list");

        function initializeTags(existingTags) {
            existingTags.forEach(tagValue => {
                if (!tags.includes(tagValue) && tags.length < 3) {
                    // Add tag to array
                    tags.push(tagValue);
                    
                    // Add tag to list
                    const tagItem = document.createElement("li");
                    tagItem.textContent = tagValue;
                    tagItem.classList.add("badge", "bg-primary", "me-2", "mb-2", "tag-item");
                    
                    // Create a delete button for each tag
                    const deleteButton = document.createElement("button");
                    deleteButton.textContent = "X";
                    deleteButton.classList.add("btn", "btn-sm", "text-white", "ms-2");
                    
                    // Add the delete functionality
                    deleteButton.addEventListener("click", function() {
                        tagItem.remove();
                        tags = tags.filter(tag => tag !== tagValue); // Remove tag from array
                        // Enable the add button if there are less than 3 tags
                        if (tags.length < 3) {
                            addTagButton.disabled = false;
                        }
                    });

                    // Append the delete button to the tag item
                    tagItem.appendChild(deleteButton);
                    
                    // Append the tag item to the list
                    tagList.appendChild(tagItem);

                    // Disable add button if there are already 3 tags
                    if (tags.length === 3) {
                        addTagButton.disabled = true;
                    }
                }
            });
        }
        const existingTags = <?= json_encode($existing_tags ?? []); ?>;
        initializeTags(existingTags);
        // Function to add tag
        addTagButton.addEventListener("click", function() {
            const tagValue = tagInput.value.trim();
            if (tagValue && !tags.includes(tagValue) && tags.length < 3) {
                // Add tag to array
                tags.push(tagValue);
                // Add tag to list
                const tagItem = document.createElement("li");
                tagItem.textContent = tagValue;
                tagItem.classList.add("badge", "bg-primary", "me-2", "mb-2", "tag-item");
                
                // Create a delete button for each tag
                const deleteButton = document.createElement("button");
                deleteButton.textContent = "X";
                deleteButton.classList.add("btn", "btn-sm", "text-white", "ms-2");
                
                // Add the delete functionality
                deleteButton.addEventListener("click", function() {
                    tagItem.remove();
                    tags = tags.filter(tag => tag !== tagValue); // Remove tag from array
                    // Enable the add button if there are less than 3 tags
                    if (tags.length < 3) {
                        addTagButton.disabled = false;
                    }
                });

                // Append the delete button to the tag item
                tagItem.appendChild(deleteButton);
                
                // Append the tag item to the list
                tagList.appendChild(tagItem);

                // Clear input
                tagInput.value = "";

                // Disable add button if there are already 3 tags
                if (tags.length === 3) {
                    addTagButton.disabled = true;
                }
            }
        });

        // Adding tags to form data on submit
        document.querySelector("form").addEventListener("submit", function() {
            // Add tags as hidden input field for form submission
            const tagsInput = document.createElement("input");
            tagsInput.type = "hidden";
            tagsInput.name = "tags"; // This will be the name of the field for your tags array
            tagsInput.value = JSON.stringify(tags); // Convert array to JSON string
            this.appendChild(tagsInput);
        });
    });
</script>





<?php include __DIR__ . '../../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

