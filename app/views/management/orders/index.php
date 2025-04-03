</head>
    <title>Orders</title>
</head>
<?php include __DIR__ . '../../../header.php'; 
$orders;
?>
<main>
    <a class="button my-4 mx-5" href="/">Go Back</a>
    <div class="d-flex justify-content-center align-items-center">  
        <div class="card p-4 my-5" style="width: 60%;">
            <h2 class="mb-4">View Orders</h2>
            <div class="table-container" style="max-height: 450px; overflow-y: auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Payment status</th>
                            <th>Date</th>
                            <th>Total amount</th>
                            <th>Tickets</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= htmlspecialchars($order->getId()); ?></td>
                                <td><?= htmlspecialchars($order->getUserEmail()); ?></td>
                                <td>
                                    <?php
                                    $status = htmlspecialchars($order->getPaymentStatus());
                                    $statusColor = ($status === 'paid') ? 'text-success' : 'text-danger';
                                    ?>
                                    <span class="<?= $statusColor; ?>"><?= $status; ?></span>
                                </td>
                                <td><?= htmlspecialchars((new DateTime($order->getOrderDate()))->format('Y-m-d H:i')); ?></td>
                                <td>
                                    <?php
                                    // Calculate total amount by summing up ticket prices
                                    $totalAmount = array_reduce($order->getTickets(), function ($sum, $ticket) {
                                        return $sum + floatval($ticket['ticket_price']);
                                    }, 0);
                                    echo "$" . number_format($totalAmount, 2, ',', '.'); // Format as currency
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-warning" onclick='showTickets(<?= json_encode($order) ?>)'>Tickets</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div id="ticketModal" class="modal" style="display:none;">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                    <h3>Tickets for Order <span id="modalOrderId"></span></h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Ticket ID</th>
                                <th>Session Name</th>
                                <th>Datetime</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody id="ticketTableBody">
                            <!-- Ticket details will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<style>
        .table-container {
        max-height: 450px;
        overflow-y: auto;
        position: relative;
    }

    .table thead {
        position: sticky;
        top: 0;
        background-color: lightgray; /* Ensures visibility */
        z-index: 10;
    }

    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        display: none; /* Hidden by default */
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        width: 80%;
        max-width: 600px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 30px;
        cursor: pointer;
    }

    /* Optional: Add styles for the table in the modal */
    .table {
        width: 100%;
        margin-top: 20px;
    }

    .table th, .table td {
        padding: 10px;
        text-align: left;
    }
</style>
<script>
    // Show the modal and populate it with ticket information
    function showTickets(order) {
        // Update the modal header with the order ID
        document.getElementById('modalOrderId').innerText = order.id;

        // Clear the current ticket table
        var ticketTableBody = document.getElementById('ticketTableBody');
        ticketTableBody.innerHTML = '';

        // Populate the ticket table with ticket details
        order.tickets.forEach(function(ticket) {
            var row = document.createElement('tr');

            var ticketIdCell = document.createElement('td');
            ticketIdCell.innerText = ticket.ticket_id;
            row.appendChild(ticketIdCell);

            var sessionNameCell = document.createElement('td');
            sessionNameCell.innerText = ticket.session_name;
            row.appendChild(sessionNameCell);

            var datetimeCell = document.createElement('td');
            datetimeCell.innerText = ticket.datetime_start;
            row.appendChild(datetimeCell);

            var ticketPriceCell = document.createElement('td');
            ticketPriceCell.innerText = ticket.ticket_price;
            row.appendChild(ticketPriceCell);

            // Append the row to the ticket table
            ticketTableBody.appendChild(row);
        });

        // Show the modal
        document.getElementById('ticketModal').style.display = 'flex';
    }

    // Close the modal
    function closeModal() {
        document.getElementById('ticketModal').style.display = 'none';
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include __DIR__ . '../../../footer.php'; ?>
