<?php
require_once __DIR__ . '/../vendor/autoload.php'; // de events laden niet in de header.php file zonder dit.
$eventRepository = new \App\Repositories\EventRepository();
$events = $eventRepository->getAll();
?>


<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/stylesheets/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="images-logos/logo.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/images-logos/logo.png" alt="Haarlem Festival Logo" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php foreach ($events as $event): ?>
                        <li class="nav-item"><a class="nav-link" href="#"><?= htmlspecialchars($event->name); ?></a></li>
                    <?php endforeach; ?>
                    <li class="nav-item"><a class="nav-link" href="#">Tickets</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/manage-users">Manage users</a></li>
                    
                    <?php if (!isset($_SESSION['user'])): ?>
                        <li class="nav-item me-5 pt-1"><a class="button" href="/login">Log In</a></li>
                    <?php else: ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                My account
                            </a>
                            <ul class="dropdown-menu">
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['type'] === 'customer'): ?>
                                    <li><a class="dropdown-item" href="/manageAccount">Manage account</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="/logout">Log Out</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS (menu Dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>