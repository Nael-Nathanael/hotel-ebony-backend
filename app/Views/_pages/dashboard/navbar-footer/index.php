<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<div class="container py-2">
    <div class="row">
        <div class="col-3">
            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    Menu
                </div>
                <div class="card-body">
                    <label>Logo</label>
                    <div style="background-color: rgb(110 94 94 / .75); backdrop-filter: blur(15px) ">
                        <div class="p-2 mb-2">
                            <?= summon_image_field("MENU", "MENU_LOGO") ?>
                        </div>
                    </div>

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
        <div class="col-3">
            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    Description
                </div>
                <div class="card-body">
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "CKEDITOR",
                                    "label" => "Contact",
                                    "id" => "MENUDESC_CONTACT",
                                ],
                                [
                                    "type" => "CKEDITOR",
                                    "label" => "Address",
                                    "id" => "MENUDESC_ADDRESS",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    Extended Menu
                </div>
                <div class="card-body">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <div class="mb-5">
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
        </div>
        <div class="col-3">
            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    Social Media Links
                </div>
                <div class="card-body">
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Link Instagram",
                                    "id" => "SOC_INSTAGRAM",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "Link Facebook",
                                    "id" => "SOC_FACEBOOK",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "Link X",
                                    "id" => "SOC_X",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "Link Youtube",
                                    "id" => "SOC_YOUTUBE",
                                ],
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

