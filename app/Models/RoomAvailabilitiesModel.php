<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomAvailabilitiesModel extends Model
{
    protected $table = 'room_availabilities';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id',
        'room_slug',
        'date',
        'count',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
