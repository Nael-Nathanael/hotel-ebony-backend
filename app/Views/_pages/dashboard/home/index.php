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
</div>
<?= $this->endSection(); ?>

