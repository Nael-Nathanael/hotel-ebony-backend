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
        $thumbnailUrl = PLACEHOLDER_IMG;
        if ($_FILES["thumbnailImg"]["name"]) {
            $path = $this->request->getFile("thumbnailImg");
            $path->move(UPLOAD_FOLDER_URL);
            $thumbnailUrl = base_url("/uploads/" . $path->getName());
        }

        // upload image
        $imgUrl = PLACEHOLDER_IMG;
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
                "label_id" => $this->request->getPost("label_id"),
                "title" => $this->request->getPost("title"),
                "title_id" => $this->request->getPost("title_id"),
                "description" => $this->request->getPost("description"),
                "description_id" => $this->request->getPost("description_id"),
                "thumbnailUrl" => $thumbnailUrl,
                "imgUrl" => $imgUrl,
                "isShownOnHomepage" => $this->request->getPost("isShownOnHomepage"),
                "isWhiteText" => $this->request->getPost("isWhiteText")
            ]
        );

        sendCalmSuccessMessage("Fasilitas berhasil didaftarkan!");
        return redirect()->route("dashboard.facilities.index");
    }

    public function update($id): RedirectResponse
    {
        $model = model("FacilitiesModel");

        $data = [
            "id" => $id,
            "label" => $this->request->getPost("label"),
            "label_id" => $this->request->getPost("label_id"),
            "title" => $this->request->getPost("title"),
            "title_id" => $this->request->getPost("title_id"),
            "isShownOnHomepage" => $this->request->getPost("isShownOnHomepage"),
            "description" => $this->request->getPost("description"),
            "description_id" => $this->request->getPost("description_id"),
            "isWhiteText" => $this->request->getPost("isWhiteText")
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

        sendCalmSuccessMessage("Fasilitas berhasil diperbarui!");
        return redirect()->route("dashboard.facilities.index");
    }

    public function delete($id): RedirectResponse
    {
        $model = model("FacilitiesModel");

        $model->delete($id);

        sendCalmSuccessMessage("Fasilitas berhasil dihapus!");
        return redirect()->route("dashboard.facilities.index");
    }

    public function get(): ResponseInterface
    {
        $model = model("FacilitiesModel");
        return $this->response->setJSON($model->findAll());
    }
}
