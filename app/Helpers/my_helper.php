<?php
if (!function_exists('summon_editable_div')) {
    function summon_editable_div(string $label, string $id, bool $multiple = false): string
    {
        return view("_components/EditableDiv", [
            "field_id" => $id,
            "field_label" => $label,
            "field_multiple" => $multiple,
        ]);
    }
}
if (!function_exists('summon_image_field')) {
    function summon_image_field(string $field_group_name, string $field_id): string
    {
        return view("_components/LinesImageClickToChangeField",
            [
                "field_group_name" => $field_group_name,
                "field_id" => $field_id,
            ]
        );
    }
}
if (!function_exists('summon_image_button')) {
    function summon_image_button(string $field_id): string
    {
        return view("_components/ButtonToChangeImage",
            [
                "field_id" => $field_id,
            ]
        );
    }
}

if (!function_exists('sendCalmSuccessMessage')) {
    function sendCalmSuccessMessage(string $message)
    {
        $session = session();
        $session->setFlashdata('success', $message);
    }
}

if (!function_exists('sendCalmErrorMessage')) {
    function sendCalmErrorMessage(string $message)
    {
        $session = session();
        $session->setFlashdata('error', $message);
    }
}

if (!function_exists('bindFlashdata')) {
    function bindFlashdata(array &$data)
    {
        $session = session();
        $data['flashdata'] = $session->getFlashdata();
    }
}

if (!function_exists('call')) {
    function call($id, $defaultValue): string
    {
        $temp = $GLOBALS["lines"]->findOrEmptyString($id);
        return $temp ?: $defaultValue;
    }
}