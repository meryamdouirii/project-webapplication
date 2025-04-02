</head>
    <title>Session Management</title>
</head>
<?php include __DIR__ . '../../../header.php'; 

?>
<main>
    <a class="button my-4 mx-5" href="/manage-events/event?event_id=<?php?>">Go Back</a>
    <div class="d-flex justify-content-center align-items-center">  
        <div class="card p-4 my-5" style="width: 60%;">
                <h2 class="mb-4">Session Management</h2>
                <button class="btn btn-primary mb-3 col-2">Add Session</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Ticket Limit</th>
                            <th>Duration (min)</th>
                            <th>Price</th>
                            <th>Start Date/Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sessionTableBody">
                        <!-- Dynamic Rows Here -->
                    </tbody>
                </table>
        </div>
    </div>
</main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include __DIR__ . '../../../footer.php'; ?>