<?php

namespace App\Models;

use CodeIgniter\Model;

class FacilityPhotoModel extends Model
{
    protected $table = 'facilities__photo';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id',
        'facility_id',
        'url',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'createdAt';
    protected $updatedField = 'updatedAt';
}
