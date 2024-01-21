<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Availabilities extends BaseController
{
    public function index(): string
    {
        $start = $_GET['s'] ?? date("Y-m-d");
        $model = model("RoomsModel");
        $rooms = $model->findAll();

        $model = model("RoomAvailabilitiesModel");
        foreach ($rooms as $room) {
            $room->availabilities = $model
                ->where("room_slug", $room->slug)
                ->where("date >= '$start'", null, false)
                ->where("date <= DATE_ADD('$start', INTERVAL 1 WEEK)", null, false)
                ->findAll();
        }

        $data['rooms'] = $rooms;
        bindFlashdata($data);
        return view("_pages/dashboard/availabilities/index", $data);
    }
}
