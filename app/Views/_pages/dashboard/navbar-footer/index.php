<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h5>Menu</h5>
            <div class="row">
                <div class="col-3">
                    <label>Logo</label>
                    <div style="background-color: rgb(110 94 94 / .75); backdrop-filter: blur(15px) ">
                        <div class="p-2 mb-2">
                            <?= summon_image_field("MENU", "MENU_LOGO") ?>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Home",
                                    "id" => "MENU_HOME",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "About",
                                    "id" => "MENU_ABOUT",
                                ],
                            ]
                        ]
                    ) ?>
                </div>

                <div class="col-3">
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Rooms & Suites",
                                    "id" => "MENU_ROOM_SUITE",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "Facilities",
                                    "id" => "MENU_FACILITY",
                                ],
                            ]
                        ]
                    ) ?>
                </div>

                <div class="col-3">
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Gallery",
                                    "id" => "MENU_GALLERY",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "Article",
                                    "id" => "MENU_ARTICLE",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "Reserve Button",
                                    "id" => "MENU_RESERVE",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
            </div>
        </div>

        <div class="col-6">
            <?= view("_components/LinesFieldGroup",
                [
                    "fields" => [
                        [
                            "type" => "CKEDITOR",
                            "label" => "<h5>Contact</h5>",
                            "id" => "MENUDESC_CONTACT",
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
                            "label" => "<h5>Address</h5>",
                            "id" => "MENUDESC_ADDRESS",
                        ],
                    ]
                ]
            ) ?>
        </div>

        <div class="col-12">
            <h5>Footer Menu</h5>
            <div class="row">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="col">
                        <?= view("_components/LinesFieldGroup",
                            [
                                "fields" => [
                                    [
                                        "type" => "LinesField",
                                        "label" => "Extra Menu ${i} Label",
                                        "id" => "EXTRAMENU_${i}_LABEL",
                                    ],
                                    [
                                        "type" => "LinesField",
                                        "label" => "Extra Menu ${i} URL",
                                        "id" => "EXTRAMENU_${i}_URL",
                                    ],
                                ]
                            ]
                        ) ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <div class="col-12">
            <h5>
                Social Media Links
            </h5>
            <div class="row">
                <div class="col">
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Link Instagram",
                                    "id" => "SOC_INSTAGRAM",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
                <div class="col">
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Link Facebook",
                                    "id" => "SOC_FACEBOOK",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
                <div class="col">
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Link X",
                                    "id" => "SOC_X",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
                <div class="col">
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Link Youtube",
                                    "id" => "SOC_YOUTUBE",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
                <div class="col">
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Link Whatsapp",
                                    "id" => "SOC_WA",
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

