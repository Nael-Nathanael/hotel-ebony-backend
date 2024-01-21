<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryPhotoModel extends Model
{
    protected $table = 'gallery__photo';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id',
        'album_slug',
        'url',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'createdAt';
    protected $updatedField = 'updatedAt';
}
