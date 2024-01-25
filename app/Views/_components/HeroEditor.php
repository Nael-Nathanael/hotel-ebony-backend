<div class="w-100 mb-4 d-flex justify-content-center flex-column text-white align-items-center position-relative"
     style="
             height: 70vh;
             max-height: 400px;
             background: url('<?= call($field_bg, PLACEHOLDER_IMG) ?>') center;
             background-size: cover;
             ">
    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="opacity: .45; z-index: 100; background-color: black"></div>
    <div style="z-index: 101" class="text-center">
        <div class="font-marcellus h1">
            <?= view("_components/LinesFieldGroup", [
                "fields" => [
                    [
                        "type" => "EditableDiv",
                        "label" => "(Page Title)",
                        "id" => $field_title
                    ]
                ]
            ]) ?>
        </div>
    </div>

    <div style="z-index: 101" class="text-center mt-2 font-marcellus h5">
        <?= view("_components/LinesFieldGroup", [
            "fields" => [
                [
                    "type" => "EditableDiv",
                    "label" => "(Page Subtitle)",
                    "id" => $field_subtitle
                ]
            ]
        ]) ?>
    </div>

    <div class="position-absolute top-0 end-0 m-2" style="z-index: 101">
        <?= summon_image_button($field_bg) ?>
    </div>
</div>