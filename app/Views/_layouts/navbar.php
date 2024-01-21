<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Hotel Ebony - Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= route_to("dashboard.home.index") ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= route_to("dashboard.about.index") ?>">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= route_to("dashboard.rooms.index") ?>">Rooms & Suites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= route_to("dashboard.facilities.index") ?>">Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= route_to("dashboard.galleries.index") ?>">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= route_to("dashboard.articles.index") ?>">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reservations</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">More</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="<?= route_to("dashboard.navbar-footer.index") ?>">
                                Navbar & Footer
                            </a>
                            <a class="dropdown-item" href="<?= route_to("dashboard.room-facilities.index") ?>">
                                Room Facility Options
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-2 flex-nowrap">
                <form action="<?= route_to("session.lang") ?>" method="post" id="langsel">
                    <select name="lang" id="lang" class="form-select form-select-sm"
                            onchange="document.getElementById('langsel').submit()">
                        <option value="" <?= session()->get("LANG") != "EN_" ? 'selected' : '' ?>>ID</option>
                        <option value="EN_" <?= session()->get("LANG") == "EN_" ? 'selected' : '' ?>>EN</option>
                    </select>
                </form>
                <a href="<?= route_to("auth.logout") ?>" class="flex-shrink-0 btn btn-outline-danger btn-sm">
                    Log Out
                </a>
            </div>
        </div>
    </div>
</nav>