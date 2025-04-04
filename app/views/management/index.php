<head>
    <title>Manage users</title>
</head>
<?php
include __DIR__ . '/../header.php';?>
<main class="container d-flex justify-content-center align-items-center vh-100">     
<div class="container mt-5">
    <?= var_dump($_SESSION['user'] )?>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['error_message']; ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['success_message']; ?>
            </div>
        <?php endif; ?>
        <?php 
            unset($_SESSION['error_message']);
            unset($_SESSION['success_message']);
        ?>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">User Management</h1>
            <a href="/manage-users/add" class="btn btn-primary">Add User</a>
        </div>
        <input type="text" id="searchBar" class="form-control mb-3" placeholder="Search users..." onkeyup="filterUsers()">
        <table id="userTable"class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user->id) ?></td>
                        <td><?= htmlspecialchars($user->type_of_user->name) ?></td>
                        <td><?= htmlspecialchars($user->first_name ?? "") ?></td>
                        <td><?= htmlspecialchars($user->last_name ?? "") ?></td>
                        <td><?= htmlspecialchars($user->email) ?></td>
                        <td><?= htmlspecialchars($user->phone_number ?? "") ?></td>
                        <td>
                        <?php echo "<a href='/manage-users/edit?id=$user->id'"?> class="btn btn-warning btn-sm">Edit</a>
                        <?php echo "<a href='/manage-users/delete?id=$user->id'"?>onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include __DIR__ . '/../footer.php';
?>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function filterUsers() {
        let input = document.getElementById("searchBar").value.toLowerCase();
        let rows = document.querySelectorAll("#userTable tbody tr");

        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });
    }
</script>
</body>