<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<?= view("_components/HeroEditor", [
    "field_bg" => "ABOUT_HERO_BG",
    "field_title" => "ABOUT_HERO_TITLE",
    "field_subtitle" => "ABOUT_HERO_SUBTITLE",
]) ?>

<div class="container py-4">

    <section class="py-4">
        <div class="row g-5 align-items-center">
            <div class="col-6">
                <div class="h2 font-marcellus mb-4">
                    <?= summon_editable_div("(Judul)", "ABOUT_HEADER_TITLE") ?>
                </div>
                <div>
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "CKEDITOR",
                                    "label" => "",
                                    "id" => "ABOUT_HEADER_SUBTITLE",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
            </div>
            <div class="col-6">
                <?= summon_image_field("HOME", "ABOUT_HEADER_IMG") ?>
            </div>
        </div>
    </section>

    <section class="py-4">
        <div class="h2 font-marcellus mb-4 d-flex justify-content-center align-items-center">
            <?= summon_editable_div("(Information)", "ABOUT_INFORMATION_TITLE") ?>
        </div>

        <div class="row align-items-center">
            <div class="col-6">
                <iframe src="<?= call("ABOUT_MAP_URL", "") ?>" style="aspect-ratio: 16 / 9"
                        class="w-100 border"></iframe>
                <?= view("_components/LinesFieldGroup",
                    [
                        "fields" => [
                            [
                                "type" => "LinesField",
                                "label" => "MAP URL",
                                "id" => "ABOUT_MAP_URL",
                            ],
                        ]
                    ]
                ) ?>
            </div>
            <div class="col-6">
                <?= view("_components/LinesFieldGroup",
                    [
                        "fields" => [
                            [
                                "type" => "CKEDITOR",
                                "label" => "",
                                "id" => "ABOUT_MAP_INFORMATION",
                            ],
                        ]
                    ]
                ) ?>
            </div>
        </div>
    </section>

    <section class="py-4">
        <div class="h2 font-marcellus mb-4 d-flex justify-content-center align-items-center">
            <?= summon_editable_div("(Explore Ebony Hotel)", "EXPLORE_TITLE") ?>
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

