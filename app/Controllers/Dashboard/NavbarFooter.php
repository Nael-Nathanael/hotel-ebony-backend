<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class NavbarFooter extends BaseController
{
    public function index(): string
    {
        $data = [];
        bindFlashdata($data);
        return view("_pages/dashboard/navbar-footer/index", $data);
    }
}
