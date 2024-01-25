<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<?= view("_components/HeroEditor", [
    "field_bg" => "HOME_HERO_BG",
    "field_title" => "HOME_HERO_TITLE",
    "field_subtitle" => "HOME_HERO_SUBTITLE",
]) ?>

<div class="container py-4">
    <section class="py-4">
        <div class="row">
            <div class="col">
                <a
                        href="<?= route_to("dashboard.articles.index") ?>"
                        class="btn btn-outline-primary w-100 d-flex justify-content-center align-items-center"
                        style="min-height: 125px">
                    Manage Articles
                </a>
            </div>
            <div class="col">
                <a
                        href="<?= route_to("dashboard.articles.index") ?>"
                        class="btn btn-outline-primary w-100 d-flex justify-content-center align-items-center"
                        style="min-height: 125px">
                    Manage Articles
                </a>
            </div>
            <div class="col">
                <a
                        href="<?= route_to("dashboard.articles.index") ?>"
                        class="btn btn-outline-primary w-100 d-flex justify-content-center align-items-center"
                        style="min-height: 125px">
                    Manage Articles
                </a>
            </div>
        </div>

    </section>
    <section class="py-4">
        <div class="row g-5 align-items-center">
            <div class="col-6">
                <div class="h2 font-marcellus mb-4">
                    <?= summon_editable_div("(Judul)", "HOME_HEADER_TITLE") ?>
                </div>
                <div>
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "CKEDITOR",
                                    "label" => "",
                                    "id" => "HOME_HEADER_SUBTITLE",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
            </div>
            <div class="col-6">
                <?= summon_image_field("HOME", "HOME_HEADER_IMG") ?>
            </div>
        </div>
    </section>

    <section class="py-4">
        <div class="h2 font-marcellus mb-4 d-flex justify-content-center align-items-center">
            <?= summon_editable_div("(Our Facility)", "HOME_FACILITY_TITLE") ?>
        </div>

        <div class="row">
            <?php for ($i = 1; $i <= 2; $i++): ?>
                <div class="col-6">
                    <div class="position-relative">
                        <img alt="HOME_CAROUSEL_IMG_<?= $i ?>"
                             src="<?= call("HOME_CAROUSEL_IMG_$i", PLACEHOLDER_IMG) ?>"
                             class="w-100" style="aspect-ratio: 16 / 9"/>

                        <div class="position-absolute top-0 end-0 m-2">
                            <?= summon_image_button("HOME_CAROUSEL_IMG_$i") ?>
                        </div>

                        <div class="position-absolute top-0 start-0 w-100 h-100 p-2 d-flex flex-column justify-content-between">
                            <div>
                                <div class="h3 font-marcellus mb-4">
                                    <?= summon_editable_div("(Title)", "HOME_CAROUSEL_TITLE_$i") ?>
                                </div>
                                <div style="text-align: justify" class="w-50 font-josefin-sans">
                                    <?= summon_editable_div("(Description)", "HOME_CAROUSEL_DESCRIPTION_$i") ?>
                                </div>
                            </div>

                            <div style="text-align: justify; width: fit-content"
                                 class="font-josefin-sans mt-auto border px-3 py-1 pt-2 border-dark">
                                <?= summon_editable_div("(Button Text)", "HOME_CAROUSEL_BUTTON_TEXT_$i") ?>
                            </div>
                        </div>
                    </div>
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "URL Tombol",
                                    "id" => "HOME_CAROUSEL_BUTTON_URL_$i",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
            <?php endfor ?>
        </div>
    </section>


    <section class="py-4">
        <div class="h2 font-marcellus mb-4 d-flex justify-content-center align-items-center">
            <?= summon_editable_div("(Rooms & Suites)", "HOME_ROOMS_TITLE") ?>
        </div>

        <a
                href="<?= route_to("dashboard.rooms.index") ?>"
                class="btn btn-outline-primary w-100 d-flex justify-content-center align-items-center"
                style="min-height: 200px">
            Manage Rooms & Suites
        </a>

        <div class="h6 font-josefin-sans mt-4 text-decoration-underline d-flex justify-content-center align-items-center">
            <?= summon_editable_div("(View All Rooms)", "HOME_ROOMS_ALL") ?>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>

