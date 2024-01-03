<?php

namespace App\Models;

use CodeIgniter\Model;

class FacilitiesModel extends Model
{
    protected $table = 'facilities';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id',
        'number',
        'label',
        'title',
        'description',
        'thumbnailUrl',
        'imgUrl',
        'isShownOnHomepage',
        'isWhiteText',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';

    public function findAll(int $limit = 0, int $offset = 0)
    {
        $this->orderBy("number ASC");
        return parent::findAll($limit, $offset);
    }
}
