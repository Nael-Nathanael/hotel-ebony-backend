<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Tnc extends BaseController
{
    public function index(): string
    {
        $data = [];
        bindFlashdata($data);
        return view("_pages/dashboard/tnc/index", $data);
    }
}
