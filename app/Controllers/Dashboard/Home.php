<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index(): string
    {
        $model = model("ArticlesModel");
        $data = [
            "articles" => $model->orderBy('created_at DESC')->findAll()
        ];
        bindFlashdata($data);
        return view("_pages/dashboard/home/index", $data);
    }
}
