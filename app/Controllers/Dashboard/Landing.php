<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Landing extends BaseController
{
    public function index(): string
    {
        $carouselBanner = model("CarouselBanner");
        $data['carouselBanners'] = $carouselBanner->findAll();

        return view("_pages/dashboard/landing/index", $data);
    }
}
