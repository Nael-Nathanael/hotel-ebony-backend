<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ["as" => "auth.page"]);
$routes->post('/', 'Home::do_auth', ["as" => "auth.do_auth"]);
$routes->post('/session.lang', 'Home::do_change_lag', ["as" => "session.lang"]);
$routes->get('/logout', 'Home::do_logout', ["as" => "auth.logout"]);

$routes->group('dashboard', function ($routes) {
    $routes->get("", "Dashboard::index", ["as" => "dashboard.landing"]);

    $routes->get('home', "Dashboard\Home::index", ["as" => "dashboard.home.index"]);
    $routes->get('about-us', "Dashboard\About::index", ["as" => "dashboard.about.index"]);
    $routes->get('room-facilities', "Dashboard\RoomFacilityOptions::index", ["as" => "dashboard.room-facilities.index"]);
    $routes->get('navbar-footer', "Dashboard\NavbarFooter::index", ["as" => "dashboard.navbar-footer.index"]);
    $routes->get('availabilities', "Dashboard\Availabilities::index", ["as" => "dashboard.availabilities.index"]);
    $routes->get('tnc', "Dashboard\Tnc::index", ["as" => "dashboard.tnc.index"]);

    $routes->group('articles', function ($routes) {
        $routes->get("", "Dashboard\Articles::index", ["as" => "dashboard.articles.index"]);
        $routes->get("create", "Dashboard\Articles::create", ["as" => "dashboard.articles.create"]);
        $routes->get("update/(:segment)", "Dashboard\Articles::update/$1", ["as" => "dashboard.articles.update"]);
    });

    $routes->group('facilities', function ($routes) {
        $routes->get("", "Dashboard\Facilities::index", ["as" => "dashboard.facilities.index"]);
        $routes->get("create", "Dashboard\Facilities::create", ["as" => "dashboard.facilities.create"]);
        $routes->get("update/(:segment)", "Dashboard\Facilities::update/$1", ["as" => "dashboard.facilities.update"]);
    });

    $routes->group('galleries', function ($routes) {
        $routes->get("", "Dashboard\Galleries::index", ["as" => "dashboard.galleries.index"]);
        $routes->get("create", "Dashboard\Galleries::create", ["as" => "dashboard.galleries.create"]);
        $routes->get("update/(:segment)", "Dashboard\Galleries::update/$1", ["as" => "dashboard.galleries.update"]);
        $routes->get("photos/(:segment)", "Dashboard\Galleries::photos/$1", ["as" => "dashboard.galleries.photos"]);
    });

    $routes->group('vouchers', function ($routes) {
        $routes->get("", "Dashboard\Vouchers::index", ["as" => "dashboard.vouchers.index"]);
        $routes->get("create", "Dashboard\Vouchers::create", ["as" => "dashboard.vouchers.create"]);
        $routes->get("update/(:segment)", "Dashboard\Vouchers::update/$1", ["as" => "dashboard.vouchers.update"]);
    });

    $routes->group('rooms', function ($routes) {
        $routes->get("", "Dashboard\Rooms::index", ["as" => "dashboard.rooms.index"]);
        $routes->get("create", "Dashboard\Rooms::create", ["as" => "dashboard.rooms.create"]);
        $routes->get("update/(:segment)", "Dashboard\Rooms::update/$1", ["as" => "dashboard.rooms.update"]);
        $routes->get("update-images/(:segment)", "Dashboard\Rooms::updateImages/$1", ["as" => "dashboard.rooms.update-images"]);
    });
});

$routes->group("object", function ($routes) {
    $routes->group('articles', function ($routes) {
        $routes->post('create', "Object\Articles::create", ["as" => "object.articles.create"]);
        $routes->post('delete/(:segment)', "Object\Articles::delete/$1", ["as" => "object.articles.delete"]);
        $routes->post('update/(:segment)', "Object\Articles::update/$1", ["as" => "object.articles.update"]);
        $routes->get('get', "Object\Articles::get", ["as" => "object.articles.get"]);
        $routes->get('get/(:segment)', "Object\Articles::get/$1", ["as" => "object.articles.getSpecific"]);
    });

    $routes->group('facilities', function ($routes) {
        $routes->post('create', "Object\Facilities::create", ["as" => "object.facilities.create"]);
        $routes->post('delete/(:segment)', "Object\Facilities::delete/$1", ["as" => "object.facilities.delete"]);
        $routes->post('update/(:segment)', "Object\Facilities::update/$1", ["as" => "object.facilities.update"]);
        $routes->get('get', "Object\Facilities::get", ["as" => "object.facilities.get"]);
    });

    $routes->group('galleries', function ($routes) {
        $routes->post('create', "Object\Galleries::create", ["as" => "object.galleries.create"]);
        $routes->post('delete/(:segment)', "Object\Galleries::delete/$1", ["as" => "object.galleries.delete"]);
        $routes->post('update/(:segment)', "Object\Galleries::update/$1", ["as" => "object.galleries.update"]);
        $routes->get('get', "Object\Galleries::get", ["as" => "object.galleries.get"]);
        $routes->post("photos/(:segment)", "Object\Galleries::photos/$1", ["as" => "object.galleries.photos"]);
        $routes->post("photos/delete/(:segment)", "Object\Galleries::photoDelete/$1", ["as" => "object.galleries.photos.delete"]);
    });

    $routes->group('rooms', function ($routes) {
        $routes->post('create', "Object\Rooms::create", ["as" => "object.rooms.create"]);
        $routes->post('delete/(:segment)', "Object\Rooms::delete/$1", ["as" => "object.rooms.delete"]);
        $routes->post('update/(:segment)', "Object\Rooms::update/$1", ["as" => "object.rooms.update"]);
        $routes->post('add-image/(:segment)', "Object\Rooms::addImage/$1", ["as" => "object.rooms.add-image"]);
        $routes->post('delete-image/(:segment)', "Object\Rooms::deleteImg/$1", ["as" => "object.rooms.delete-image"]);
        $routes->post('sync-availabilities', "Object\Rooms::syncAvailabilities", ["as" => "object.rooms.sync-availabilities"]);
        $routes->post('sync-availabilities-single', "Object\Rooms::syncSingleAvailabilities", ["as" => "object.rooms.sync-availabilities-single"]);
        $routes->post('sync', "Object\Rooms::sync", ["as" => "object.rooms.sync"]);
        $routes->get('get', "Object\Rooms::get", ["as" => "object.rooms.get"]);
    });

    $routes->group('reservations', function ($routes) {
        $routes->post('create', "Object\Reservations::create", ["as" => "object.reservations.create"]);
        $routes->get('get', "Object\Reservations::get", ["as" => "object.reservations.get"]);
        $routes->get('get-new', "Object\Reservations::getNew", ["as" => "object.reservations.get-new"]);
        $routes->get('get/(:segment)', "Object\Reservations::getById/$1", ["as" => "object.reservations.get-by-id"]);
        $routes->post('ack', "Object\Reservations::ack", ["as" => "object.reservations.ack"]);
    });

    $routes->group('room-facilities', function ($routes) {
        $routes->post('create', "Object\RoomFacilityOptions::create", ["as" => "object.room-facilities.create"]);
        $routes->post('delete/(:segment)', "Object\RoomFacilityOptions::delete/$1", ["as" => "object.room-facilities.delete"]);
        $routes->post('update', "Object\RoomFacilityOptions::update", ["as" => "object.room-facilities.update"]);
        $routes->post('updateImg/(:segment)', "Object\RoomFacilityOptions::updateImg/$1", ["as" => "object.room-facilities.updateImg"]);
        $routes->get('get', "Object\Rooms::get", ["as" => "object.room-facilities.get"]);
    });

    $routes->group('vouchers', function ($routes) {
        $routes->post('create', "Object\Vouchers::create", ["as" => "object.vouchers.create"]);
        $routes->post('delete/(:segment)', "Object\Vouchers::delete/$1", ["as" => "object.vouchers.delete"]);
        $routes->post('update/(:segment)', "Object\Vouchers::update/$1", ["as" => "object.vouchers.update"]);
        $routes->post('sync', "Object\Vouchers::sync", ["as" => "object.vouchers.sync"]);
        $routes->get('get', "Object\Vouchers::get_all", ["as" => "object.vouchers.get"]);
        $routes->get('get/(:segment)', "Object\Vouchers::get/$1", ["as" => "object.vouchers.get_single"]);
    });

    $routes->group('lines', function ($routes) {
        $routes->post('upload', "Object\Lines::upload", ["as" => "object.lines.upload"]);
        $routes->post('dumpUpload', "Object\Lines::dumpUpload", ["as" => "object.lines.dumpUpload"]);
        $routes->post('update/(:segment)', "Object\Lines::update/$1", ["as" => "object.lines.update"]);
        $routes->post('update/EN_/(:segment)', "Object\Lines::updateEn/$1", ["as" => "object.lines.update.en"]);
        $routes->get('get/(:segment)', "Object\Lines::getByKey/$1", ["as" => "object.lines.getByKey"]);
        $routes->post('getFormatted', "Object\Lines::getFormatted", ["as" => "object.lines.getFormatted"]);
        $routes->post('getFormatted/EN_', "Object\Lines::getFormattedEn", ["as" => "object.lines.getFormattedEn"]);
    });
});

$routes->options('(:any)', "Object\Articles::get", ["as" => "object.articles.get"]);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
