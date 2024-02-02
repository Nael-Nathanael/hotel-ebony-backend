<?php
$field_label = str_replace("(", "", $field_label);
$field_label = str_replace(")", "", $field_label);

$lang = session()->get("LANG") ? 'EN' : 'ID'
?>

<div class="position-relative" style="width: fit-content">
    <div style="width: 20px; height: 20px; font-size: 10px; left: calc(100% + 5px)"
         id="editable_div__<?= $field_id ?>_edit_button"
         onclick="editableDiv__onEditButtonClick('<?= $field_id ?>')"
         class="position-absolute bg-primary translate-middle-y cursor-pointer text-white small border-white border rounded-circle d-flex justify-content-center align-items-center top-0">
        <i class="bi bi-pen"></i>
    </div>
    <div style="width: 20px; height: 20px; font-size: 12px; left: calc(100% + 5px)"
         id="editable_div__<?= $field_id ?>_save_button"
         onclick="editableDiv__onSaveButtonClick('<?= $field_id ?>', '<?= isset($field_multiple) && $field_multiple ? 'true' : 'false' ?>')"
         class="position-absolute d-none bg-success translate-middle-y text-white cursor-pointer border-white border rounded-circle d-flex justify-content-center align-items-center top-0">
        <i class="bi bi-check"></i>
    </div>
    <div style="width: 20px; height: 20px; font-size: 12px; left: calc(100% + 30px)"
         id="editable_div__<?= $field_id ?>_reset_button"
         onclick="editableDiv__onResetButtonClick('<?= $field_id ?>')"
         class="position-absolute d-none bg-warning translate-middle-y text-white cursor-pointer border-white border rounded-circle d-flex justify-content-center align-items-center top-0">
        <i class="bi bi-arrow-clockwise"></i>
    </div>
    <div id="editable_div__<?= $field_id ?>"
         onblur="editableDiv__onSaveButtonClick('<?= $field_id ?>', '<?= isset($field_multiple) && $field_multiple ? 'true' : 'false' ?>')"
         onclick="editableDiv__onEditButtonClick('<?= $field_id ?>')"
         class="<?= isset($field_multiple) && $field_multiple ? "editable_div_multiple" : "editable_div" ?>"
         data-id="<?= $field_id ?>" data-multiple='<?= isset($field_multiple) && $field_multiple ? 'true' : 'false' ?>'
         style="outline: none"
    >
        <?= call($field_id, "") ?>
    </div>
    <span id="editable_div__<?= $field_id ?>_placeholder"
          onclick="editableDiv__onEditButtonClick('<?= $field_id ?>')"
          style="color: #9f9f9f"><?= $GLOBALS["lines"]->findOrEmptyString($field_id) == "" ? "($lang: $field_label)" : '' ?></span>
    <span class="text-success d-none bg-white px-2 py-1 badge rounded-pill mx-auto position-absolute start-50 translate-middle-x"
          style="font-size: 12px"
          id="<?= $field_id ?>__saved_indicator">saved</span>
</div>