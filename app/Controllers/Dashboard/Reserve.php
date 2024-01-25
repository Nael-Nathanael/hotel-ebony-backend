<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Reserve extends BaseController
{
    public function index(): string
    {
        $data = [];
        bindFlashdata($data);
        return view("_pages/dashboard/reserve/index", $data);
    }
}
