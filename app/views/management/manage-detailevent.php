<head>
    <title>Edit Detail Event</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
</head>
<?php include __DIR__ . '/../header.php'; 
use App\Services\UploadService;?>
<main class="container-fluid p-0 mb-5">

<form  method="POST">
        <textarea name="content" id="editor"></textarea>
        <br>
        <button type="submit">Save Content</button>
    </form>

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
</main>

<?php include __DIR__ . '/../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
