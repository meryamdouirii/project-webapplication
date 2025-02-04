<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/customerview">
            <img src="https://png.pngtree.com/png-clipart/20211024/original/pngtree-hair-logo-png-image_6872014.png" alt="Logo" style="width: 80px;"> BeautyTherapy
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/customerview">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="behandelingenDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Behandelingen
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="behandelingenDropdown">
                        <li><a class="dropdown-item" href="/behandelingen/facetreatment">Gezichtsbehandeling</a></li>
                        <li><a class="dropdown-item" href="/behandelingen/massage">Massage</a></li>
                        <li><a class="dropdown-item" href="/behandelingen/harsen">Harsen</a></li>
                        <li><a class="dropdown-item" href="/behandelingen/microdermabrasie">Microdermabrasie</a></li>
                        <li><a class="dropdown-item" href="/behandelingen/hennabrows">Henna Brows</a></li>
                        <li><a class="dropdown-item" href="/behandelingen/microneedling">Microneedling</a></li>
                        <li><a class="dropdown-item" href="/behandelingen/biopeeling">Biopeeling</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/appointment">Afspraak maken</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/myAppointments">Mijn afspraken</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">Over ons</a>
                </li>
            </ul>

            <form action="/logout" method="POST">
                <button type="submit" class="btn btn-pink mx-3">Logout</button>
            </form>
            
            
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
