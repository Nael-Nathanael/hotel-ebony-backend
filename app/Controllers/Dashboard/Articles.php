<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Articles extends BaseController
{
    public function index(): string
    {
        $articles = model("ArticlesModel");
        $data['articles'] = $articles->orderBy("created_at DESC")->findAll();
        bindFlashdata($data);
        return view("_pages/dashboard/articles/index", $data);
    }

    public function create(): string
    {
        $data = [];
        bindFlashdata($data);
        return view("_pages/dashboard/articles/create", $data);
    }

    public function update($slug): string
    {
        $articles = model("ArticlesModel");
        $data['article'] = $articles->find($slug);
        bindFlashdata($data);
        return view("_pages/dashboard/articles/update", $data);
    }
}
