<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomImagesModel extends Model
{
    protected $table = 'room_imgs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id',
        'room_slug',
        'imgUrl',
    ];

    // Dates
    protected $useTimestamps = false;
}
