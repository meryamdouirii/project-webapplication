<head>
    <title>Edit Detail Event</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
</head>
<?php include __DIR__ . '/../header.php'; 
use App\Services\UploadService;?>
<main class="container" style="margin-top:5%; margin-bottom:5%;">     
    <div class="d-flex justify-content-start mb-2">
        <a href="/manage-users" class="button">Go Back</a>
    </div>
    <div class="d-flex justify-content-center align-items-center">  
        <div class="card p-4 my-5" style="width: 60%;">
        <h3 class="text-center">Edit Page</h3>
            <div id="error-message" style="display: none;" class="alert alert-danger" role="alert">
            </div>
            
    <form  method="POST">
        <textarea name="content" id="editor"></textarea>
        <br>
        <button type="submit">Save Content</button>
    </form>
        </div>
    </div>
</main>
<script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '/manageDetailEvent/uploadImage'
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
<?php include __DIR__ . '/../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
