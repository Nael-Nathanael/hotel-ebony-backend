<?php
/**
 * @var String $field_id
 * @var String $field_group_name
 */

$lines = model("Lines");
?>

<div class="position-relative">
    <img src="<?= $lines->findOrPlaceholderImage($field_id) ?>" class="w-100 rounded" alt=""
         style="aspect-ratio: 16 / 9; object-fit: cover;">
    <div class="position-absolute top-0 end-0 m-2">
        <?= summon_image_button($field_id) ?>
    </div>
    <div class="text-end small text-danger">*recommended 1,280px x 720px (16 : 9 ratio)</div>
</div>