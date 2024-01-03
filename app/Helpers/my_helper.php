<?php
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