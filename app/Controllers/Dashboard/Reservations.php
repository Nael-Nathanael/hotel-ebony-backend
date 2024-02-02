<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Reservations extends BaseController
{
    public function index(): string
    {
        $model = model("ReservationsModel");
        $data = [
            "reservations" => $model->findAll()
        ];
        bindFlashdata($data);
        return view("_pages/dashboard/reservations/index", $data);
    }
}
