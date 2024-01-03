<?php

namespace App\Controllers\Object;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Facilities extends BaseController
{
    public function create(): RedirectResponse
    {
        $model = model("FacilitiesModel");

        // upload thumbnail image
        $thumbnailUrl = '/img/BannerBG_LandingPage.jpg';
        if ($_FILES["thumbnailImg"]["name"]) {
            $path = $this->request->getFile("thumbnailImg");
            $path->move(UPLOAD_FOLDER_URL);
            $thumbnailUrl = base_url("/uploads/" . $path->getName());
        }

        // upload image
        $imgUrl = '/img/BannerBG_LandingPage.jpg';
        if ($_FILES["img"]["name"]) {
            $path = $this->request->getFile("img");
            $path->move(UPLOAD_FOLDER_URL);
            $imgUrl = base_url("/uploads/" . $path->getName());
        }

        // get count
        $number = $model->countAll();

        $model->insert(
            [
                "number" => $number,
                "label" => $this->request->getPost("label"),
                "title" => $this->request->getPost("title"),
                "thumbnailUrl" => $thumbnailUrl,
                "imgUrl" => $imgUrl,
                "isShownOnHomepage" => $this->request->getPost("isShownOnHomepage"),
            ]
        );

        return redirect()->to(previous_url());
    }

    public function update($id): RedirectResponse
    {
        $model = model("FacilitiesModel");

        $data = [
            "label" => $this->request->getPost("label"),
            "title" => $this->request->getPost("title"),
            "isShownOnHomepage" => $this->request->getPost("isShownOnHomepage"),
        ];

        // upload thumbnail image
        if ($_FILES["thumbnailImg"]["name"]) {
            $path = $this->request->getFile("thumbnailImg");
            $path->move(UPLOAD_FOLDER_URL);
            $data['thumbnailUrl'] = base_url("/uploads/" . $path->getName());
        }

        // upload image
        if ($_FILES["img"]["name"]) {
            $path = $this->request->getFile("img");
            $path->move(UPLOAD_FOLDER_URL);
            $data['imgUrl'] = base_url("/uploads/" . $path->getName());
        }

        $model->save($data);

        return redirect()->to(previous_url());
    }


    public function delete($id): RedirectResponse
    {
        $model = model("FacilitiesModel");

        $model->delete($id);

        return redirect()->to(previous_url());
    }

    public function get(): ResponseInterface
    {
        $model = model("FacilitiesModel");
        return $this->response->setJSON($model->findAll());
    }
}
