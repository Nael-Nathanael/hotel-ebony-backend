<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Checkout extends BaseController
{
    public function index(): string
    {
        $data = [];
        bindFlashdata($data);
        return view("_pages/dashboard/checkout/index", $data);
    }
}
