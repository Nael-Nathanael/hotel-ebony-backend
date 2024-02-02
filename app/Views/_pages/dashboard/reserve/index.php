<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<?= view("_components/HeroEditor", [
    "field_bg" => "RESERVE_HERO_BG",
    "field_title" => "RESERVE_HERO_TITLE",
    "field_subtitle" => "RESERVE_HERO_SUBTITLE",
]) ?>

<div class="container pb-5 pt-2">

    <section class="p-4 shadow position-relative">
        <div class="bg-white border border-dark rounded px-2 py-1 shadow position-absolute top-0 start-0"
             style="transform: translate(-30%, -50%)">Template
        </div>
        <div class="row g-3">
            <div class="col-3">
                <div class="w-100 border d-flex justify-content-center align-items-center"
                     style="aspect-ratio: 16 / 9">
                    {{ Room Photo }}
                </div>
            </div>
            <div class="col-9 justify-content-between d-flex flex-column">
                <div>
                    <p class="fs-3 text-uppercase mb-0 font-josefin-sans">{{ Room Name }}</p>
                    <p class="font-josefin-sans">{{ Room Description }}</p>

                </div>
                <div class="text-decoration-underline font-josefin-sans"
                     style="color: #6e5e5e">
                    <?= summon_editable_div("(Room details)", "RESERVE_ROOM_DETAILS_BUTTON") ?>
                </div>
            </div>
            <div class="col-6">
                {{ Room Facility 1 }}<br>
                {{ Room Facility 2 }}<br>
                {{ Room Facility 3 }}<br>
                {{ Room Facility 4 }}
            </div>
            <div class="col-6 text-end">
                
            </div>
        </div>
    </section>

</div>
<?= $this->endSection(); ?>

