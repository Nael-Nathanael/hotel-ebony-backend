<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<?= view("_components/HeroEditor", [
    "field_bg" => "ABOUT_HERO_BG",
    "field_title" => "ABOUT_HERO_TITLE",
    "field_subtitle" => "ABOUT_HERO_SUBTITLE",
]) ?>

<div class="container py-2">
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
                                    "id" => "ABOUT_HEADER_TITLE",
                                ],
                                [
                                    "type" => "CKEDITOR",
                                    "label" => "Deskripsi",
                                    "id" => "ABOUT_HEADER_SUBTITLE",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
                <div class="col-6">
                    <?= summon_image_field("HOME", "ABOUT_HEADER_IMG") ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadown-sm mb-3">
        <div class="card-body text-center">
            <?= view("_components/LinesFieldGroup",
                [
                    "fields" => [
                        [
                            "type" => "LinesField",
                            "label" => "Information Section",
                            "id" => "ABOUT_INFORMATION_TITLE",
                        ],
                    ]
                ]
            ) ?>
            <div class="row">
                <div class="col-6">
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
                                    "type" => "LinesField",
                                    "label" => "Map Information",
                                    "id" => "ABOUT_MAP_INFORMATION",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm mb-3">
        <div class="card-header">
            <?= view("_components/LinesFieldGroup",
                [
                    "fields" => [
                        [
                            "type" => "LinesField",
                            "label" => "Explore Ebony Hotel",
                            "id" => "EXPLORE_TITLE",
                        ],
                    ]
                ]
            ) ?>
        </div>
        <div class="card-body text-center">
            <div class="row g-3">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="col-4">
                        <div class="card h-100 card-body bg-light text-secondary fs-4 d-flex justify-content-center align-items-center">
                            Facility <?= $i + 1 ?>
                        </div>
                    </div>
                <?php endfor ?>
                <div class="col-4">
                    <?= summon_image_field("ABOUT", "EXPLORE_ROOMS_AND_SUITES_IMG") ?>

                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Rooms and Suites Title",
                                    "id" => "EXPLORE_ROOMS_AND_SUITES",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "Rooms and Suites Description",
                                    "id" => "EXPLORE_ROOMS_AND_SUITES_DESCRIPTION",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>

