</head>
    <title>Session Management</title>
</head>
<?php include __DIR__ . '../../../header.php'; 
$detail_event;
?>
<main>
    <a class="button my-4 mx-5" href="/manage-events/manage-detailevents?detailevent_id=<?php echo $detail_event->getId() ?>">Go Back</a>
    <div class="d-flex justify-content-center align-items-center">  
        <div class="card p-4 my-5" style="width: 60%;">
                <h2 class="mb-4">Session Management</h2>
                <a href="/manage-sessions/add-session?detailevent_id=<?php echo $detail_event->getId() ?>" class="btn btn-primary mb-3 col-2">Add Session</a>

                <div class="table-container" style="max-height: 450px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Location</th>
                                <th>Ticket Limit</th>
                                <th>Duration (min)</th>
                                <th>Price ($)</th>
                                <th>Start Date/Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sessionTableBody">
                            <?php foreach ($sessions as $session): ?>
                                <tr>
                                    <td><?= htmlspecialchars($session->getId()); ?></td>
                                    <td><?= htmlspecialchars($session->getName()); ?></td>
                                    <td><?= htmlspecialchars($session->getDescription() ?? " "); ?></td>
                                    <td><?= htmlspecialchars($session->getLocation()?? " " ); ?></td>
                                    <td><?= htmlspecialchars($session->getTicketLimit()); ?></td>
                                    <td><?= htmlspecialchars($session->getDurationMinutes()); ?></td>
                                    <td><?= htmlspecialchars($session->getPrice()); ?></td>
                                    <td><?= htmlspecialchars($session->getDate()); ?> <?= htmlspecialchars($session->getStartTime()); ?></td>
                                    <td>
                                        <a href="/manage-sessions/edit-session?session_id=<?= urlencode($session->getId()); ?>" class="btn btn-warning">Edit</a>
                                        <a href="/manage-sessions/delete-session?session_id=<?= urlencode($session->getId()); ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include __DIR__ . '../../../footer.php'; ?>
