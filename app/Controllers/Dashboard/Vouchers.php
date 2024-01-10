<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Vouchers extends BaseController
{
    public function index(): string
    {
        $model = model("VouchersModel");
        $data['vouchers'] = $model->findAll();
        bindFlashdata($data);
        return view("_pages/dashboard/vouchers/index", $data);
    }

    public function create(): string
    {
        $data = [];
        bindFlashdata($data);
        return view("_pages/dashboard/vouchers/create", $data);
    }

    public function update($slug): string
    {
        $model = model("VouchersModel");
        $data['voucher'] = $model->find($slug);
        bindFlashdata($data);
        return view("_pages/dashboard/vouchers/update", $data);
    }
}
