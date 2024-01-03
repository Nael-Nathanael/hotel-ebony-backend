<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomBedsModel extends Model
{
    protected $table = 'room_beds';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id',
        'room_slug',
        'bed_type',
        'bed_count',
    ];

    // Dates
    protected $useTimestamps = false;
}
