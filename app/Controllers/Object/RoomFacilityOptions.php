<?php

namespace App\Controllers\Object;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class RoomFacilityOptions extends BaseController
{
    public function create(): RedirectResponse
    {
        $model = model("RoomFacilitiesOptionModel");

        // upload thumbnail image
        $icon = PLACEHOLDER_IMG;
        if ($_FILES["icon"]["name"]) {
            $path = $this->request->getFile("icon");
            $path->move(UPLOAD_FOLDER_URL);
            $icon = base_url("/uploads/" . $path->getName());
        }

        $slug = url_title($this->request->getPost("name"));
        $finalSlug = $slug;
        $counter = 1;
        while ($model->find($finalSlug)) {
            $finalSlug = $slug . "-" . $counter++;
        }

        $model->insert(
            [
                "slug" => $slug,
                "name" => $this->request->getPost("name"),
                "icon" => $icon,
                "order_number" => $model->countAll(),
            ]
        );

        sendCalmSuccessMessage("Fasilitas berhasil didaftarkan!");
        return redirect()->route("dashboard.room-facilities.index");
    }

    public function update()
    {
        $model = model("RoomFacilitiesOptionModel");

        $data = [
            "slug" => $this->request->getJSON()->slug,
            "name" => $this->request->getJSON()->name,
        ];

        $model->save($data);

        return $this->response->setJSON([
            "msg" => "ok"
        ]);
    }

    public function updateImg($slug)
    {
        $model = model("RoomFacilitiesOptionModel");

        $data = [
            "slug" => $slug,
        ];

        $path = $this->request->getFile("icon");
        $path->move(UPLOAD_FOLDER_URL);
        $data['icon'] = base_url("/uploads/" . $path->getName());

        $model->save($data);

        sendCalmSuccessMessage("Icon berhasil diubah!");
        return redirect()->back();
    }


    public function delete($slug): RedirectResponse
    {
        $model = model("RoomFacilitiesOptionModel");

        $model->delete($slug);

        sendCalmSuccessMessage("Fasilitas berhasil dihapus!");
        return redirect()->route("dashboard.room-facilities.index");
    }

    public function get(): ResponseInterface
    {
        $model = model("RoomFacilitiesOptionModel");
        return $this->response->setJSON($model->findAll());
    }
}
