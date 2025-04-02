<head>
    <title>The Haarlem Festival</title>
</head>
<?php include __DIR__ . '../../../header.php'; ?>
<main>
    <a class="button my-4 mx-5" href="/manage-events">Go Back</a>
    <section class="p-4">
        <h2 class="text-center">Manage <?=$picked_event->name?> content</h2>
        <div class="container mt-5">	
            <div class="row justify-content-center mb-4">
                <div class="col-md-3">
                    <a href="/manage-events/edit-mainevent?event_id=<?= urlencode($picked_event->id); ?>" class="card">
                        <div class="card-body">
                            <h5 class="card-title">Main page</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="/manage-events/manage-detailevents?event_id=<?= urlencode($picked_event->id); ?>" class="card">
                        <div class="card-body">
                            <h5 class="card-title">Event pages</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-md-3">
                    <a href="/manage-events/manage-sessions?event_id=<?= urlencode($picked_event->id); ?>" class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage event sessions</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </section>
</main>
<?php include __DIR__ . '../../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
