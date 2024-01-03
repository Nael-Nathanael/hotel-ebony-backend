<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [];
        bindFlashdata($data);
        return view("_pages/dashboard/home/index", $data);
    }
}
