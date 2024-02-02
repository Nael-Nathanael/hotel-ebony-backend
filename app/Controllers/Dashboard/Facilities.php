<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Facilities extends BaseController
{
    public function index(): string
    {
        $model = model("FacilitiesModel");
        $data['facilities'] = $model->findAll();
        bindFlashdata($data);
        return view("_pages/dashboard/facilities/index", $data);
    }

    public function create(): string
    {
        $data = [];
        bindFlashdata($data);
        return view("_pages/dashboard/facilities/create", $data);
    }

    public function update($slug): string
    {
        $model = model("FacilitiesModel");
        $data['facility'] = $model->find($slug);
        bindFlashdata($data);
        return view("_pages/dashboard/facilities/update", $data);
    }

    public function photos($slug): string
    {
        $model = model("FacilitiesModel");
        $data['facility'] = $model->find($slug);
        $model = model("FacilityPhotoModel");
        $data['photos'] = $model->orderBy("createdAt", "ASC")->where("facility_id", $slug)->findAll();
        bindFlashdata($data);
        return view("_pages/dashboard/facilities/photos", $data);
    }
}
