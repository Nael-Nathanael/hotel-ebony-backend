<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Faq extends BaseController
{
    public function index(): string
    {
        $data = [];
        bindFlashdata($data);
        return view("_pages/dashboard/faq/index", $data);
    }

    public function create(): string
    {
        $data = [];
        bindFlashdata($data);
        return view("_pages/dashboard/faq/create", $data);
    }

    public function update($slug): string
    {
        $faq = model("FaqModel");
        $data['faq'] = $faq->find($slug);
        bindFlashdata($data);
        return view("_pages/dashboard/faq/update", $data);
    }
}
