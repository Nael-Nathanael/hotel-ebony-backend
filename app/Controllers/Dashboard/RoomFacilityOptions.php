<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class RoomFacilityOptions extends BaseController
{
    public function index(): string
    {
        $model = model("RoomFacilitiesOptionModel");
        $data['options'] = $model->findAll();
        bindFlashdata($data);
        return view("_pages/dashboard/room-facilities/index", $data);
    }
}
