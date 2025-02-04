<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BeautyTherapy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/style.css" rel="stylesheet">
</head>

<body>
    <div class="treatment-header">
        <div class="container">
            <h1 class="treatment-title">Login</h1>
        </div>
    </div>
    <main class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card treatment-card shadow">
                    <div class="card-body p-5">
                        <form method="post" action="/login" class="space-y-4">
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Wachtwoord</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-pink w-100 mb-3">Inloggen</button>
                        </form>
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger mt-4">
                                <?= htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>