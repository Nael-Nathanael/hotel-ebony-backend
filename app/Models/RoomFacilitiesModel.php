<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomFacilitiesModel extends Model
{
    protected $table = 'room__room_facility';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id',
        'room_slug',
        'room_facility_slug',
    ];

    // Dates
    protected $useTimestamps = false;

    public function findByRoomSlug($room_slug)
    {
        return $this
            ->select("room_facilities.*")
            ->join("room_facilities", "room_facilities.slug = room__room_facility.room_facility_slug", "left")
            ->where("room_slug", $room_slug)
            ->orderBy("room_facilities.order_number", "ASC")
            ->findAll();
    }
}
