<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class RoomsModel extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'slug';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'slug',
        'name',
        'type',
        'description',
        'price',
        'rate_code',
        'order_number',
        'capacity',
        'size',
        'deleted_at',
    ];

    // Dates
    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function findAll(int $limit = 0, int $offset = 0)
    {
        $this->orderBy("order_number ASC");
        return parent::findAll($limit, $offset);
    }

    public function findComplete($slug = false)
    {
        $imageModel = model("RoomImagesModel");
        $bedModel = model("RoomBedsModel");
        $facilityModel = model("RoomFacilitiesModel");
        $availabilityModel = model("RoomAvailabilitiesModel");

        if ($slug) {
            $rooms = $this->where("slug", $slug)->findAll();
        } else {
            $rooms = $this->findAll();
        }

        foreach ($rooms as $room) {
            $room->images = $imageModel->where("room_slug", $room->slug)->findAll();

            if (count($room->images) == 0) {
                $room->images = [
                    (object)[
                        "id" => 0,
                        "room_slug" => $room->slug,
                        "imgUrl" => PLACEHOLDER_IMG
                    ]
                ];
            }
            $room->beds = $bedModel->where("room_slug", $room->slug)->findAll();
            $room->facilities = $facilityModel->findByRoomSlug($room->slug);
            $availabilities = $availabilityModel
                ->where("date", date("Y-m-d"))
                ->where("room_slug", $room->slug)->findAll();
            $room->avalabilities = $availabilities;
        }

        if ($slug) return $rooms[0];

        return $rooms;
    }

    public function findCompleteWithFilter($filter = [])
    {
        $imageModel = model("RoomImagesModel");
        $bedModel = model("RoomBedsModel");
        $facilityModel = model("RoomFacilitiesModel");
        $availabilityModel = model("RoomAvailabilitiesModel");

        if (array_key_exists("slug", $filter)) {
            $this->where("slug", $filter["slug"]);
        }
        $rooms = $this->findAll();

        foreach ($rooms as $room) {
            $availabilities = $availabilityModel
                ->where("room_slug", $room->slug);

            if (array_key_exists('s', $filter)) {
                $availabilities->where("date >= '${filter['s']}'", null, false);
            } else {
                $availabilities->where("date", date("Y-m-d"));
            }

            if (array_key_exists('e', $filter)) {
                $availabilities->where("date < '${filter['e']}'", null, false);
            }

            if (array_key_exists('c', $filter)) {
                $availabilities->where("count >= '${filter['c']}'", null, false);
            }

            $room->availabilities = $availabilities->findAll();

            if (array_key_exists('s', $filter) && array_key_exists('e', $filter)) {
                $date1 = new DateTime($filter['s']);
                $date2 = new DateTime($filter['e']);

                $interval = $date1->diff($date2)->days;

                if (count($room->availabilities) < $interval) {
                    $room->availabilities = [];
                }
            }

            $room->images = $imageModel->where("room_slug", $room->slug)->findAll();

            if (count($room->images) == 0) {
                $room->images = [
                    (object)[
                        "id" => 0,
                        "room_slug" => $room->slug,
                        "imgUrl" => PLACEHOLDER_IMG
                    ]
                ];
            }
            $room->beds = $bedModel->where("room_slug", $room->slug)->findAll();
            $room->facilities = $facilityModel->findByRoomSlug($room->slug);
        }

        return $rooms;
    }
}
