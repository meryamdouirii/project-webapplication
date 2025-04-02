</head>
    <title>Add Session</title>
</head>
<?php include __DIR__ . '../../../header.php'; 
?>
<main>
    <a class="button my-4 mx-5" href="javascript:window.history.back();">Go Back</a>
    <div class="d-flex justify-content-center align-items-center">  
        <div class="card p-4 my-5" style="width: 40%;">
                <h2 class="mb-4">Add the session</h2>
                <form method="POST">
                    <input type="hidden" name="detailevent_id" value="<?= htmlspecialchars($detailevent_id); ?>">
                    <div class="mb-3">
                    <label for="name" class="form-label">Name the event session*</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location">
                    </div>
                    <div class="mb-3">
                    <label for="price" class="form-label">Price ($)*</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                    <label for="ticket_limit" class="form-label">Ticket Limit*</label>
                    <input type="number" class="form-control" id="ticket_limit" name="ticket_limit" required>
                    </div>
                    <div class="row mb-3">
                    <div class="col">
                        <label for="date_start" class="form-label">Start Date*</label>
                        <input type="date" class="form-control" id="date_start" name="date_start" required>
                    </div>
                    <div class="col">
                        <label for="time_start" class="form-label">Start Time*</label>
                        <input type="time" class="form-control" id="time_start" name="time_start" required>
                    </div>
                    </div>
                    <div class="mb-3">
                    <label for="duration_minutes" class="form-label">Duration (in minutes)*</label>
                    <input type="number" class="form-control" id="duration_minutes" name="duration_minutes" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

        </div>
    </div>
</main>

<script>
  // Set minimum date to today
  document.addEventListener('DOMContentLoaded', function() {
    // Get today's date in YYYY-MM-DD format
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;
    
    // Set the minimum date attribute
    document.getElementById('date_start').min = formattedDate;
    
    // Set validation for form submission
    document.getElementById('sessionForm').addEventListener('submit', function(event) {
      const dateInput = document.getElementById('date_start');
      const selectedDate = new Date(dateInput.value);
      selectedDate.setHours(0, 0, 0, 0); // Reset time part for comparison
      
      const currentDate = new Date();
      currentDate.setHours(0, 0, 0, 0); // Reset time part for comparison
      
      if (selectedDate < currentDate) {
        alert('Please select a date in the future.');
        event.preventDefault();
      }
    });
  });
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include __DIR__ . '../../../footer.php'; ?>