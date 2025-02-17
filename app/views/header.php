<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="stylesheets/style.css" rel="stylesheet">
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
                    <li class="nav-item"><a class="nav-link" href="#">Yummy</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Dance</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tickets</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if (!isset($_SESSION['user'])): ?>
                    <li class="nav-item"><a class="button" href="/login">Log In</a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item"><a class="button" href="/logout">Log Out</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>