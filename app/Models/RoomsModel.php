<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomsModel extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'slug';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'slug',
        'name',
        'type',
        'description',
        'price',
        'order_number',
        'capacity',
        'size',
    ];

    // Dates
    protected $useTimestamps = false;

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

        if ($slug) {
            $rooms = $this->where("slug", $slug)->findAll();
        } else {
            $rooms = $this->findAll();
        }

        foreach ($rooms as $room) {
            $room->images = $imageModel->where("room_slug", $room->slug)->findAll();
            $room->beds = $bedModel->where("room_slug", $room->slug)->findAll();
            $room->facilities = $facilityModel->findByRoomSlug($room->slug);
        }

        if ($slug) return $rooms[0];

        return $rooms;
    }
}
