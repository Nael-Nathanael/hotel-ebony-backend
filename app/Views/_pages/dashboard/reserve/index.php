<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<?= view("_components/HeroEditor", [
    "field_bg" => "RESERVE_HERO_BG",
    "field_title" => "RESERVE_HERO_TITLE",
    "field_subtitle" => "RESERVE_HERO_SUBTITLE",
]) ?>

<div class="container py-2">

</div>
<?= $this->endSection(); ?>

