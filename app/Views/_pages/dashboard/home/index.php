<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<div class="container py-2">
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <?= summon_image_field("HOME", "HOME_HERO_BG") ?>
                </div>
                <div class="col-6">
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Judul",
                                    "id" => "HOME_HERO_TITLE",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "Subjudul",
                                    "id" => "HOME_HERO_SUBTITLE",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Judul",
                                    "id" => "HOME_HEADER_TITLE",
                                ],
                                [
                                    "type" => "CKEDITOR",
                                    "label" => "Deskripsi",
                                    "id" => "HOME_HEADER_SUBTITLE",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
                <div class="col-6">
                    <?= summon_image_field("HOME", "HOME_HEADER_IMG") ?>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="card-body text-center">
            <?= view("_components/LinesFieldGroup",
                [
                    "fields" => [
                        [
                            "type" => "LinesField",
                            "label" => "Facility Section",
                            "id" => "HOME_FACILITY_TITLE",
                        ],
                    ]
                ]
            ) ?>
        </div>
    </div>
    <div class="card shadow-sm mb-3">
        <div class="card-header">
            Carousel
        </div>
        <div class="card-body text-center">
            <div class="row">
                <div class="col-6">
                    <?= summon_image_field("HOME", "HOME_CAROUSEL_IMG_1") ?>
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Judul",
                                    "id" => "HOME_CAROUSEL_TITLE_1",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "Deskripsi",
                                    "id" => "HOME_CAROUSEL_DESCRIPTION_1",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "Teks Tombol",
                                    "id" => "HOME_CAROUSEL_BUTTON_TEXT_1",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "URL Tombol",
                                    "id" => "HOME_CAROUSEL_BUTTON_URL   _1",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
                <div class="col-6">
                    <?= summon_image_field("HOME", "HOME_CAROUSEL_IMG_2") ?>
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Judul",
                                    "id" => "HOME_CAROUSEL_TITLE_2",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "Deskripsi",
                                    "id" => "HOME_CAROUSEL_DESCRIPTION_2",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "Teks Tombol",
                                    "id" => "HOME_CAROUSEL_BUTTON_TEXT_2",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "URL Tombol",
                                    "id" => "HOME_CAROUSEL_BUTTON_URL_2",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body text-center">
            <?= view("_components/LinesFieldGroup",
                [
                    "fields" => [
                        [
                            "type" => "LinesField",
                            "label" => "Rooms & Suites Section",
                            "id" => "HOME_ROOMS_TITLE",
                        ],
                        [
                            "type" => "LinesField",
                            "label" => "View All Rooms",
                            "id" => "HOME_ROOMS_ALL",
                        ],
                    ]
                ]
            ) ?>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>

