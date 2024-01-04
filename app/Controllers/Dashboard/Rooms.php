<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Rooms extends BaseController
{
    public function index(): string
    {
        $model = model("RoomsModel");
        $data['rooms'] = $model->findComplete();
        bindFlashdata($data);
        return view("_pages/dashboard/rooms/index", $data);
    }

    public function create(): string
    {
        $data = [];
        $model = model("RoomFacilitiesOptionModel");
        $data['facility_options'] = $model->findAll();
        bindFlashdata($data);
        return view("_pages/dashboard/rooms/create", $data);
    }

    public function update($slug): string
    {
        $model = model("RoomsModel");
        $data['room'] = $model->findComplete($slug);
        bindFlashdata($data);
        return view("_pages/dashboard/rooms/update", $data);
    }
}
