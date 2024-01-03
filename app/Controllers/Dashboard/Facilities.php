<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Facilities extends BaseController
{
    public function index(): string
    {
        $model = model("FacilitiesModel");
        $data['facilities'] = $model->findAll();
        return view("_pages/dashboard/facilities/index", $data);
    }

    public function create(): string
    {
        return view("_pages/dashboard/facilities/create");
    }

    public function update($slug): string
    {
        $model = model("FacilitiesModel");
        $data['facility'] = $model->find($slug);
        return view("_pages/dashboard/facilities/update", $data);
    }
}
