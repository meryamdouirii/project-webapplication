<head>
    <title>The Haarlem Festival</title>
</head>
<?php include __DIR__ . '../../../header.php'; ?>
<main>
    <section class="p-4 my-5 ">
        <h2 class="text-center">Pick an event to edit</h3>
        <div class="container mt-5">	
            <div class="row justify-content-center">
                <?php foreach ($events as $event): ?>
                    <div class="col-md-3">
                        <a href="/manage-events/event?event_id=<?= urlencode($event->id); ?>" class="card">
                            <img src="<?= htmlspecialchars($event->picture_homepage ?? 'default.jpg'); ?>"
                                alt="<?= htmlspecialchars($event->name); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($event->name); ?></h5>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php include __DIR__ . '../../../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>