<?php

namespace App\Models;

use CodeIgniter\Model;

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
        'deleted_at'
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
            $room->avalability = count($availabilities) > 0 ? $availabilities[0] : null;
        }

        if ($slug) return $rooms[0];

        return $rooms;
    }
}
