<button
        type="button"
        onclick="document.getElementById('button_change_img__<?= $field_id ?>').click()"
        class="btn btn-sm btn-primary">
    <i class="bi bi-pen"></i> Edit
</button>

<form action="<?= route_to('object.lines.upload') ?>" method="post"
      id="button_change_img__<?= $field_id ?>_form" enctype="multipart/form-data">
    <input type="hidden" name="key" value="<?= $field_id ?>">
    <input type="hidden" name="group_name" value="">
    <input class="d-none" id="button_change_img__<?= $field_id ?>"
           name="<?= $field_id ?>"
           accept="image/*"
           onchange="document.getElementById('button_change_img__<?= $field_id ?>_form').submit()"
           type="file">
</form>