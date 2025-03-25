<head>
    <title>Edit Detail Event</title>
</head>
<?php include __DIR__ . '../../../header.php'; 
use App\Services\UploadService;?>
<main class="container" style="margin-top:5%; margin-bottom:5%;">     
    <div class="d-flex justify-content-start mb-2">
        <a href="/manage-events/manage-detailevents?event_id=<?=htmlspecialchars($picked_event->id)?>" class="button">Go Back</a>
    </div>
    <div class="d-flex justify-content-center align-items-center">  
        <div class="card p-4 my-5" style="width: 60%;">
           <h1 class="card-title text-center">Edit <?=htmlspecialchars($picked_event->name)?></h1>
            
        </div>
    </div>
</main>






<?php include __DIR__ . '../../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

