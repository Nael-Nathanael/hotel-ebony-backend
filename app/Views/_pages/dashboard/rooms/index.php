<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>
<?= view("_components/HeroEditor", [
    "field_bg" => "ROOM_HERO_BG",
    "field_title" => "ROOM_HERO_TITLE",
    "field_subtitle" => "ROOM_HERO_SUBTITLE",
]) ?>

    <div class="container my-3">
        <section>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Rooms and Suites
                    </div>
                    <div class="card-toolkit">
                        <a class="btn btn-outline-success btn-sm" href="<?= route_to("dashboard.rooms.create") ?>">
                            Create New
                        </a>
                    </div>
                </div>
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
                                                     style="aspect-ratio: 2 / 1; object-fit: cover; object-position: center;">
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
                                    <p class="fs-5"><?= $room->name ?></p>
                                    <p><?= $room->description ?></p>

                                    <table>
                                        <tr>
                                            <th>Type</th>
                                            <td>
                                                <div class="ms-4 me-1">:</div>
                                            </td>
                                            <td><?= $room->type ?></td>
                                        </tr>
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
    </div>
<?= $this->endSection(); ?>