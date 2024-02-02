<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<?= view("_components/HeroEditor", [
    "field_bg" => "FACILITY_HERO_BG",
    "field_title" => "FACILITY_HERO_TITLE",
    "field_subtitle" => "FACILITY_HERO_SUBTITLE",
]) ?>


<div class="container mb-5">

    <div class="position-relative shadow p-4 mt-3 mb-5">
        <div class="row align-items-center gx-3">
            <div class="col-3 text-end font-marcellus fs-4 text-uppercase text-secondary">
                {{ Facility Label }}
            </div>
            <div class="col-6">
                <img src="<?= PLACEHOLDER_IMG ?>" alt="placeholder image" class="w-100" style="aspect-ratio: 16 / 9"/>
            </div>
            <div class="col-3 font-marcellus">
                <div class="d-flex flex-column gap-4">
                    <h3>
                        {{ Facility Label }}
                    </h3>
                    <p>
                        {{ Facility Description }}
                    </p>

                    <div class="position-relative">
                        <div class="btn border rounded-0" style="cursor: default;">
                            <?= summon_editable_div("(View More)", "FACILITY_VIEW_MORE_BUTTON") ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2 position-absolute border top-0 start-100 translate-middle px-2 py-1 bg-white"
             style="width: fit-content">
            Template
        </div>
    </div>

    <div class="w-100 text-end mb-5">
        <a class="btn btn-primary btn-sm" href="<?= route_to("dashboard.facilities.create") ?>">
            <i class="bi bi-plus"></i> <?= session()->get("LANG") ? 'Add New Hotel Facility' : 'Tambahkan Fasilitas Hotel' ?>
        </a>
    </div>

    <?php foreach ($facilities as $index => $facility): ?>
        <?php
        if (!isset($facility->images)) {
            $facility->images = [];
        }
        array_unshift($facility->images, (object)[
            "url" => $facility->imgUrl
        ]);
        ?>
        <div class="position-relative border p-4 mt-3 mb-5">
            <div class="row align-items-center gx-3">
                <div class="col-3 text-end font-marcellus fs-4 text-uppercase text-secondary">
                    <?php if (session()->get("LANG") == "EN_"): ?>
                        <?= $facility->label ?>
                    <?php else: ?>
                        <?= $facility->label_id ?: $facility->label ?>
                    <?php endif ?>
                </div>
                <div class="col-6">
                    <div class="w-100 position-relative">
                        <div id="carousel<?= $index ?>" class="carousel slide">
                            <div class="carousel-indicators">
                                <?php foreach ($facility->images as $imgIdx => $img): ?>
                                    <button type="button" data-bs-target="#carousel<?= $index ?>"
                                            data-bs-slide-to="<?= $imgIdx ?>"
                                        <?php if ($imgIdx == 0): ?>
                                            class="active" aria-current="true"
                                        <?php endif; ?>
                                            aria-label="Slide <?= $imgIdx + 1 ?>"></button>
                                <?php endforeach; ?>
                            </div>
                            <div class="carousel-inner">
                                <?php foreach ($facility->images as $imgIdx => $img): ?>
                                    <div class="carousel-item <?= $imgIdx == 0 ? 'active' : '' ?>">
                                        <img src="<?= $img->url ?>" class="d-block w-100"
                                             alt="<?= $facility->label ?>"
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

                        <div class="position-absolute top-0 end-0" style="z-index: 10">
                            <div class="m-2">
                                <a href="<?= route_to("dashboard.facilities.images", $facility->id) ?>"
                                   class="btn btn-primary btn-sm">
                                    <i class="bi bi-images me-1"></i> Manage Images
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 font-marcellus">
                    <div class="d-flex flex-column gap-4">
                        <h3>
                            <?php if (session()->get("LANG") == "EN_"): ?>
                                <?= $facility->label ?>
                            <?php else: ?>
                                <?= $facility->label_id ?: $facility->label ?>
                            <?php endif ?>
                        </h3>
                        <p>
                            <?php if (session()->get("LANG") == "EN_"): ?>
                                <?= $facility->description ?>
                            <?php else: ?>
                                <?= $facility->description_id ?: $facility->description ?>
                            <?php endif ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 position-absolute top-0 start-100 translate-middle p-2 bg-white"
                 style="width: fit-content">
                <a class="btn btn-warning btn-sm text-nowrap text-white"
                   href="<?= route_to("dashboard.facilities.update", $facility->id) ?>">
                    <i class="bi bi-pen"></i>
                </a>

                <form action="<?= route_to("object.facilities.delete", $facility->id) ?>"
                      method="post">
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmBeforeSubmit(
                                            this,
                                            'Hapus Fasilitas?',
                                            'Fasilitas yang telah dihapus tidak dapat dikembalikan'
                                        )">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection(); ?>
