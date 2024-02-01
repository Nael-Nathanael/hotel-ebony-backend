<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>
<?= view("_components/HeroEditor", [
    "field_bg" => "ROOM_HERO_BG",
    "field_title" => "ROOM_HERO_TITLE",
    "field_subtitle" => "ROOM_HERO_SUBTITLE",
]) ?>

    <div class="container my-3">

        <section class="p-4 shadow position-relative">
            <div class="bg-white border border-dark rounded px-2 py-1 shadow position-absolute top-0 start-0" style="transform: translate(-30%, -50%)">Template Room</div>
            <div class="row g-5">
                <div class="col-6">
                    <div class="w-100 border d-flex justify-content-center align-items-center"
                         style="aspect-ratio: 16 / 9">
                        {{ Room Photo }}
                    </div>
                </div>
                <div class="col-6 justify-content-between d-flex flex-column">
                    <div>
                        <p class="fs-3 text-uppercase mb-0 font-josefin-sans">{{ Room Name }}</p>
                        <p class="font-josefin-sans">{{ Room Description }}</p>

                        <table class="small">
                            <tr>
                                <th>Price</th>
                                <td>
                                    <div class="ms-4 me-1">:</div>
                                </td>
                                <td>{{ Room Price }}</td>
                            </tr>
                            <tr>
                                <th>Capacity</th>
                                <td>
                                    <div class="ms-4 me-1">:</div>
                                </td>
                                <td>{{ Room Capacity }}</td>
                            </tr>
                            <tr>
                                <th>Room Size</th>
                                <td>
                                    <div class="ms-4 me-1">:</div>
                                </td>
                                <td>{{ Room Size }}</td>
                            </tr>
                            <tr>
                                <th>Bed Options</th>
                                <td>
                                    <div class="ms-4 me-1">:</div>
                                </td>
                                <td>
                                    {{ Bed Options }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="d-flex gap-4 align-items-baseline">
                        <div class="px-2 py-1 text-white text-uppercase" style="background-color: #6e5e5e">
                            <?= summon_editable_div("(RESERVE)", "ROOM_RESERVE_BUTTON") ?>
                        </div>
                        <div class="px-2 text-decoration-underline fw-bold font-josefin-sans text-uppercase" style="color: #6e5e5e">
                            <?= summon_editable_div("(Learn More)", "ROOM_LEARN_MORE_BUTTON") ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="my-5"></div>

        <section class="p-4">
            <div class="w-100 text-end">
                <a class="btn btn-outline-success btn-sm" href="<?= route_to("dashboard.rooms.create") ?>">
                    <i class="bi bi-plus"></i> <?= session()->get("LANG") ? "Tambahkan Rooms & Suites" : "Create Rooms & Suites" ?>
                </a>
            </div>
            <div class="mt-4">
                <div>
                    <?php foreach ($rooms as $index => $room): ?>

                        <div class="row mb-4 g-2">
                            <div class="col-6">
                                <div id="carousel<?= $index ?>" class="carousel slide" style="max-width: 600px">
                                    <div class="carousel-indicators">
                                        <?php foreach ($room->images as $imgIdx => $img): ?>
                                            <button type="button" data-bs-target="#carousel<?= $index ?>"
                                                    data-bs-slide-to="<?= $imgIdx ?>"
                                                <?php if ($imgIdx == 0): ?>
                                                    class="active" aria-current="true"
                                                <?php endif; ?>
                                                    aria-label="Slide <?= $imgIdx + 1 ?>"></button>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="carousel-inner">
                                        <?php foreach ($room->images as $imgIdx => $img): ?>
                                            <div class="carousel-item <?= $imgIdx == 0 ? 'active' : '' ?>">
                                                <img src="<?= $img->imgUrl ?>" class="d-block w-100"
                                                     alt="<?= $room->name ?>"
                                                     style="aspect-ratio: 16 / 9; object-fit: cover; object-position: center;">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carousel<?= $index ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                            data-bs-target="#carousel<?= $index ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-6 justify-content-between d-flex flex-column">
                                <div>
                                    <p class="fs-3 text-uppercase mb-0 font-josefin-sans"><?= $room->name ?></p>
                                    <p class="font-josefin-sans"><?= $room->description ?></p>

                                    <table class="small">
                                        <tr>
                                            <th>Price</th>
                                            <td>
                                                <div class="ms-4 me-1">:</div>
                                            </td>
                                            <td>Rp <?= $room->price ?> / night</td>
                                        </tr>
                                        <tr>
                                            <th>Capacity</th>
                                            <td>
                                                <div class="ms-4 me-1">:</div>
                                            </td>
                                            <td><?= $room->capacity ?> Guest(s)</td>
                                        </tr>
                                        <tr>
                                            <th>Room Size</th>
                                            <td>
                                                <div class="ms-4 me-1">:</div>
                                            </td>
                                            <td><?= (float)$room->size ?> M<sup>2</sup></td>
                                        </tr>
                                        <tr>
                                            <th>Bed Options</th>
                                            <td>
                                                <div class="ms-4 me-1">:</div>
                                            </td>
                                            <td>
                                                <?php
                                                $bed_options = [];
                                                foreach ($room->beds as $bed) {
                                                    $bed_type = ucfirst(strtolower($bed->bed_type));
                                                    $bed_options[] = "$bed->bed_count $bed_type Bed(s)";
                                                }

                                                echo implode(" / ", $bed_options)
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="d-flex gap-2">

                                    <a class="btn btn-primary btn-sm text-white fw-bold"
                                       href="<?= route_to("dashboard.rooms.update-images", $room->slug) ?>">
                                        Edit Images
                                    </a>

                                    <a class="btn btn-warning btn-sm text-white fw-bold"
                                       href="<?= route_to("dashboard.rooms.update", $room->slug) ?>">
                                        Edit
                                    </a>

                                    <form action="<?= route_to("object.rooms.delete", $room->slug) ?>"
                                          method="post">
                                        <button type="button" class="btn btn-danger btn-sm fw-bold" onclick="confirmBeforeSubmit(
                                            this,
                                            'Hapus Ruangan?',
                                            'Ruangan yang telah dihapus tidak dapat dikembalikan'
                                        )">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <div class="my-5"></div>

        <section class="py-4">
            <div class="h2 font-marcellus mb-4 d-flex justify-content-center align-items-center">
                <?= summon_editable_div("(Featured Offers)", "ROOM_FEATURED_OFFER_TITLE") ?>
            </div>

            <div class="row g-3">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="col-4">
                        <div style="aspect-ratio: 16 / 9"
                             class="card w-100 card-body bg-light text-secondary fs-4 d-flex justify-content-center align-items-center">
                            Facility
                            <small style="font-size: 14px">(Edit via <a class="text-decoration-none"
                                                                        href="<?= route_to("dashboard.facilities.index") ?>">Facilities
                                    Menu</a>)</small>
                        </div>
                    </div>
                <?php endfor ?>
                <div class="col-4">
                    <?= summon_image_field("ABOUT", "EXPLORE_ROOMS_AND_SUITES_IMG") ?>

                    <div class="my-2 fs-4 font-josefin-sans">
                        <?= summon_editable_div("(Rooms & Suites)", "EXPLORE_ROOMS_AND_SUITES") ?>
                    </div>

                    <?= summon_editable_div("(Rooms & Suites)", "EXPLORE_ROOMS_AND_SUITES_DESCRIPTION") ?>
                </div>
            </div>
        </section>
    </div>
<?= $this->endSection(); ?>