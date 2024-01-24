<?php

function call($id, $defaultValue): string
{
    $temp = $GLOBALS["lines"]->findOrEmptyString($id);
    return $temp ?: $defaultValue;
}

?>

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
                    <a class="nav-link" href="<?= route_to("dashboard.home.index") ?>">
                        <?= call("MENU_HOME", "Home") ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= route_to("dashboard.about.index") ?>">
                        <?= call("MENU_ABOUT", "About") ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= route_to("dashboard.rooms.index") ?>">
                        <?= call("MENU_ROOM_SUITE", "Rooms & Suites") ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= route_to("dashboard.facilities.index") ?>">
                        <?= call("MENU_FACILITY", "Facilities") ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= route_to("dashboard.galleries.index") ?>">
                        <?= call("MENU_GALLERY", "Gallery") ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= route_to("dashboard.articles.index") ?>">
                        <?= call("MENU_ARTICLE", "Articles") ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"
                       onclick="Swal.fire('Under Construction', 'Reserve page is still under construction, please wait :)', 'info')">
                        <?= call("MENU_RESERVE", "Reserve") ?>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                       aria-expanded="false">More</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#"
                               onclick="Swal.fire('Under Construction', 'This page is still under construction, please wait :)', 'info')">
                                Manage Reservations
                            </a>
                            <a class="dropdown-item" href="<?= route_to("dashboard.availabilities.index") ?>">
                                Room Availabilities
                            </a>
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