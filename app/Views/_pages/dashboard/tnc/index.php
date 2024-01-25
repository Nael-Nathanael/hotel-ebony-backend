<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<?= view("_components/HeroEditor", [
    "field_bg" => "TNC_HERO_BG",
    "field_title" => "TNC_HERO_TITLE",
    "field_subtitle" => "TNC_HERO_SUBTITLE",
]) ?>

<div class="container py-2">
    <?= view("_components/LinesFieldGroup",
        [
            "fields" => [
                [
                    "type" => "CKEDITOR",
                    "label" => "",
                    "id" => "TNC_CONTENT",
                ],
            ]
        ]
    ) ?>
</div>
<?= $this->endSection(); ?>

