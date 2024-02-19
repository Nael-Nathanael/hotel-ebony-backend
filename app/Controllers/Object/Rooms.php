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
                "description_id" => $this->request->getPost("description_id"),
                "price" => $this->request->getPost("price"),
                "capacity" => $this->request->getPost("capacity"),
                "size" => $this->request->getPost("size"),
                "tnc" => $this->request->getPost("tnc"),
                "tnc_id" => $this->request->getPost("tnc_id"),
                "min_alotment" => $this->request->getPost("min_alotment"),
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
            "description_id" => $this->request->getPost("description_id"),
            "price" => $this->request->getPost("price"),
            "capacity" => $this->request->getPost("capacity"),
            "size" => $this->request->getPost("size"),
            "tnc" => $this->request->getPost("tnc"),
            "tnc_id" => $this->request->getPost("tnc_id"),
            "min_alotment" => $this->request->getPost("min_alotment"),
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

        if (count($_GET) > 0) {
            return $this->response->setJSON($model->findCompleteWithFilter($_GET));
        }
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

    public function sync()
    {
        $model = model("RoomsModel");
        $bedModel = model("RoomBedsModel");

        // Authorize integration key
        $header = $this->request->headers();
        if (!array_key_exists(EBONY_INTEGRATION_KEY_KEY, $header)) {
            return $this->response->setStatusCode(409)->setJSON("Please provide integration key");
        }

        if ($header[EBONY_INTEGRATION_KEY_KEY]->getValue() != EBONY_INTEGRATION_KEY) {
            return $this->response->setStatusCode(409)->setJSON("Wrong integration key");
        }

        // get json body
        $data = $this->request->getJSON();

        // container for sent ids
        $ids = [];

        foreach ($data as $datum) {

            // update rooms data
            $datum->slug = $datum->id;
            $model->withDeleted()->save($datum);

            $bedModel->where("room_slug", $datum->id)->delete();
            foreach ($datum->beds as $bedding) {
                $bedModel->insert([
                    "room_slug" => $datum->id,
                    "bed_type" => $bedding->bed_type,
                    "bed_count" => $bedding->bed_count,
                ]);
            }

            // push ids to array
            $ids[] = $datum->id;
        }

        // delete all room where id does not get sent from server
        $model
            ->whereNotIn("slug", $ids)
            ->delete();

        // restore all room where id is sent from server
        $model
            ->withDeleted()
            ->whereIn("slug", $ids)
            ->set("deleted_at", null)
            ->update();

        return $this->response->setJSON([
            "msg" => "ok"
        ]);
    }

    public function syncAvailabilities()
    {
        // Authorize integration key
        $header = $this->request->headers();
        if (!array_key_exists(EBONY_INTEGRATION_KEY_KEY, $header)) {
            return $this->response->setStatusCode(409)->setJSON("Please provide integration key");
        }

        if ($header[EBONY_INTEGRATION_KEY_KEY]->getValue() != EBONY_INTEGRATION_KEY) {
            return $this->response->setStatusCode(409)->setJSON("Wrong integration key");
        }

        $data = $this->request->getJSON();

        $model = model("RoomAvailabilitiesModel");

        foreach ($data as $datum) {
            $date = $datum->date;
            foreach ($datum->availabilities as $availability) {
                $existing_instance = $model
                    ->where("date", $date)
                    ->where("room_slug", $availability->id)
                    ->findAll();

                if (!isset($availability->price)) {
                    $availability->price = null;
                }

                if ($existing_instance) {
                    $model->update(
                        $existing_instance[0]->id,
                        [
                            "count" => $availability->count,
                            "price" => $availability->price,
                            "rate_code" => $availability->rate_code
                        ]
                    );
                } else {
                    $model->insert([
                        "date" => $date,
                        "room_slug" => $availability->id,
                        "count" => $availability->count,
                        "price" => $availability->price,
                        "rate_code" => $availability->rate_code
                    ]);
                }
            }
        }

        return $this->response->setJSON([
            "msg" => "ok"
        ]);
    }

    public function syncSingleAvailabilities()
    {
        $data = $this->request->getJSON();

        $model = model("RoomAvailabilitiesModel");

        $existing_instance = $model
            ->where("room_slug", $data->room_slug)
            ->where("date", $data->date)->findAll();

        if (count($existing_instance) > 0) {
            $query = $model
                ->where("room_slug", $data->room_slug)
                ->where("date", $data->date);

            $updatable_data = array_filter((array)$data, function ($key) {
                return $key != "room_slug" || $key != "date";
            }, ARRAY_FILTER_USE_KEY);

            foreach ($updatable_data as $key => $value) {
                $query->set($key, $value);
            }

            $query->update();
        } else {
            $model->insert($data);
        }

        return $this->response->setJSON([
            "msg" => "ok"
        ]);
    }
}
