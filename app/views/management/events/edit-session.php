</head>
    <title>Edit Session</title>
</head>
<?php include __DIR__ . '../../../header.php'; 
$session;
?>
<main>
    <a class="button my-4 mx-5" href="javascript:window.history.back();">Go Back</a>
    <div class="d-flex justify-content-center align-items-center">  
        <div class="card p-4 my-5" style="width: 60%;">
            <h2 class="mb-4">Edit the session</h2>
            <form method="POST">
                <input type="hidden" name="session_id" value="<?= htmlspecialchars($session->getId()); ?>">
                <input type="hidden" name="detailevent_id" value="<?= htmlspecialchars($session->getDetailEventId()); ?>">
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name the event session*</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="<?= htmlspecialchars($session->getName()); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($session->getDescription() ?? ""); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" 
                           value="<?= htmlspecialchars($session->getLocation() ?? ""); ?>">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price ($)*</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" 
                           value="<?= htmlspecialchars($session->getPrice()); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="ticket_limit" class="form-label">Ticket Limit*</label>
                    <input type="number" class="form-control" id="ticket_limit" name="ticket_limit" 
                           value="<?= htmlspecialchars($session->getTicketLimit()); ?>" required>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="date_start" class="form-label">Start Date*</label>
                        <input type="date" class="form-control" id="date_start" name="date_start" 
                            value="<?= htmlspecialchars(date('Y-m-d', strtotime($session->getDateTimeStart()))); ?>" required>
                    </div>
                    <div class="col">
                        <label for="time_start" class="form-label">Start Time*</label>
                        <input type="time" class="form-control" id="time_start" name="time_start" 
                               value="<?= htmlspecialchars($session->getStartTime()); ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="duration_minutes" class="form-label">Duration (in minutes)*</label>
                    <input type="number" class="form-control" id="duration_minutes" name="duration_minutes" 
                           value="<?= htmlspecialchars($session->getDurationMinutes()); ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include __DIR__ . '../../../footer.php'; ?>
