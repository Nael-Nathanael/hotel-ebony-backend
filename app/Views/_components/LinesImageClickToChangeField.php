<?php
/**
 * @var String $field_id
 * @var String $field_group_name
 */

$lines = model("Lines");
?>

<div class="position-relative imagePreview rounded cursor-pointer text-center"
     onclick="document.getElementById('<?= $field_id ?>').click()">
    <img src="<?= $lines->findOrPlaceholderImage($field_id) ?>" class="w-100 rounded" alt=""
         style="aspect-ratio: 16 / 9; object-fit: cover;">
    <div class="position-absolute top-50 start-50 translate-middle h3 mb-0 text-warning d-none">
        Click to Change
    </div>
    <div class="text-end small text-danger">
        <label for="">*recommended 1,280px x 720px (16 : 9 ratio)</label>
    </div>
</div>

<form action="<?= route_to('object.lines.upload') ?>" method="post"
      id="<?= $field_id . "_form" ?>" enctype="multipart/form-data">
    <input type="hidden" name="key" value="<?= $field_id ?>">
    <input type="hidden" name="group_name" value="<?= $field_group_name ?>">
    <input class="d-none" id="<?= $field_id ?>"
           name="<?= $field_id ?>"
           onchange="document.getElementById('<?= $field_id . "_form" ?>').submit()"
           type="file">
</form>