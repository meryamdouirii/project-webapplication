<head>
    <title>Edit Detail Event</title>
</head>
<?php include __DIR__ . '../../../header.php'; 
use App\Services\UploadService;?>
<main class="container" style="margin-top:5%; margin-bottom:5%;">     
    <div class="d-flex justify-content-start mb-2">
        <a href="/manage-events/event?event_id=<?=$picked_event->id?>" class="button">Go Back</a>
    </div>
    <div class="d-flex justify-content-center align-items-center">  
        <div class="card p-4 my-5" style="width: 60%;">
            <h3 class="card-title text-center">Edit content</h3>
            <div class="d-flex justify-content-end mb-3">
                <a href="/manage-events/add-detailevent?main_event_id=<?= urlencode($picked_event->id); ?>" class="btn btn-primary">Add New Event</a>
            </div>
            <!--<pre> <?php print_r($detailEvents) ?></pre>-->
            <div class="row mb-4">
                <?php foreach ($detailEvents as $detail): ?>
                    <div class="col-md-4 mb-4">
                        <a href="/manage-events/edit-detailevent?detailevent_id=<?= urlencode($detail->getId()); ?>" class="card h-100 d-flex flex-column">

                            <img src="<?= htmlspecialchars($detail->getCardImage() ?? '/images-logos/default.jpg'); ?>"
                                alt="<?= htmlspecialchars($detail->getName()); ?>" class="card-img-top img-fluid">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($detail->getName()); ?></h5>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '../../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
