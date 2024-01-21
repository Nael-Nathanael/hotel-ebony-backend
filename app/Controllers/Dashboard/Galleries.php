<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Galleries extends BaseController
{
    public function index(): string
    {
        $model = model("GalleryAlbumModel");
        $data['galleries'] = $model->findAll();
        bindFlashdata($data);
        return view("_pages/dashboard/galleries/index", $data);
    }

    public function create(): string
    {
        $data = [];
        bindFlashdata($data);
        return view("_pages/dashboard/galleries/create", $data);
    }

    public function update($slug): string
    {
        $model = model("GalleryAlbumModel");
        $data['gallery'] = $model->find($slug);
        bindFlashdata($data);
        return view("_pages/dashboard/galleries/update", $data);
    }

    public function photos($slug): string
    {
        $model = model("GalleryAlbumModel");
        $data['gallery'] = $model->find($slug);
        $model = model("GalleryPhotoModel");
        $data['photos'] = $model->where("album_slug", $slug)->findAll();
        bindFlashdata($data);
        return view("_pages/dashboard/galleries/photos", $data);
    }
}
