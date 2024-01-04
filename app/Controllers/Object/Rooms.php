<?php

namespace App\Controllers\Object;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Rooms extends BaseController
{
    public function create(): RedirectResponse
    {
        $model = model("RoomsModel");

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
                "type" => $this->request->getPost("type"),
                "description" => $this->request->getPost("description"),
                "price" => $this->request->getPost("price"),
                "capacity" => $this->request->getPost("capacity"),
                "size" => $this->request->getPost("size"),
            ]
        );

        $room_bed_model = model("RoomBedsModel");

        if ($this->request->getPost("king_bed_count") != "0") {
            $room_bed_model->insert([
                "room_slug" => $slug,
                "bed_type" => "KING",
                "bed_count" => $this->request->getPost("king_bed_count")
            ]);
        }

        if ($this->request->getPost("queen_bed_count") != "0") {
            $room_bed_model->insert([
                "room_slug" => $slug,
                "bed_type" => "QUEEN",
                "bed_count" => $this->request->getPost("queen_bed_count")
            ]);
        }

        if ($this->request->getPost("twin_bed_count") != "0") {
            $room_bed_model->insert([
                "room_slug" => $slug,
                "bed_type" => "TWIN",
                "bed_count" => $this->request->getPost("twin_bed_count")
            ]);
        }

        $room_facility_model = model("RoomFacilitiesModel");

        foreach ($this->request->getPost("facility_option") as $fa) {
            $room_facility_model->insert([
                "room_slug" => $slug,
                "room_facility_slug" => $fa
            ]);
        }

        sendCalmSuccessMessage("Room berhasil didaftarkan!");
        return redirect()->route("dashboard.rooms.index");
    }

    public function update($slug): RedirectResponse
    {
        $model = model("RoomsModel");

        $data = [
            "slug" => $slug,
            "name" => $this->request->getPost("name"),
            "type" => $this->request->getPost("type"),
            "description" => $this->request->getPost("description"),
            "price" => $this->request->getPost("price"),
            "capacity" => $this->request->getPost("capacity"),
            "size" => $this->request->getPost("size"),
        ];

        $model->save(
            $data
        );

        $room_bed_model = model("RoomBedsModel");
        $room_bed_model->where(["room_slug" => $slug])->delete();

        if ($this->request->getPost("king_bed_count") != "0") {
            $room_bed_model->insert([
                "room_slug" => $slug,
                "bed_type" => "KING",
                "bed_count" => $this->request->getPost("king_bed_count")
            ]);
        }

        if ($this->request->getPost("queen_bed_count") != "0") {
            $room_bed_model->insert([
                "room_slug" => $slug,
                "bed_type" => "QUEEN",
                "bed_count" => $this->request->getPost("queen_bed_count")
            ]);
        }

        if ($this->request->getPost("twin_bed_count") != "0") {
            $room_bed_model->insert([
                "room_slug" => $slug,
                "bed_type" => "TWIN",
                "bed_count" => $this->request->getPost("twin_bed_count")
            ]);
        }

        $room_facility_model = model("RoomFacilitiesModel");
        $room_facility_model->where(["room_slug" => $slug])->delete();

        foreach ($this->request->getPost("facility_option") as $fa) {
            $room_facility_model->insert([
                "room_slug" => $slug,
                "room_facility_slug" => $fa
            ]);
        }

        sendCalmSuccessMessage("Room berhasil diperbarui!");
        return redirect()->route("dashboard.rooms.index");
    }


    public function delete($id): RedirectResponse
    {
        $model = model("RoomsModel");

        $model->delete($id);

        sendCalmSuccessMessage("Ruangan berhasil dihapus!");
        return redirect()->route("dashboard.rooms.index");
    }

    public function get(): ResponseInterface
    {
        $model = model("RoomsModel");
        return $this->response->setJSON($model->findComplete());
    }

    public function addImage($room_slug)
    {
        $model = model("RoomImagesModel");

        $path = $this->request->getFile("img");
        $path->move(UPLOAD_FOLDER_URL);
        $imgUrl = base_url("/uploads/" . $path->getName());

        $model->insert([
            "room_slug" => $room_slug,
            "imgUrl" => $imgUrl
        ]);

        sendCalmSuccessMessage("Gambar berhasil ditambahkan!");
        return redirect()->back();
    }

    public function deleteImg($imgId)
    {
        $model = model("RoomImagesModel");

        $model->delete($imgId);

        sendCalmSuccessMessage("Gambar berhasil dihapus!");
        return redirect()->back();
    }
}
