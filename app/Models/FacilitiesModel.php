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
        'label_id',
        'title',
        'title_id',
        'description',
        'description_id',
        'thumbnailUrl',
        'imgUrl',
        'isShownOnHomepage',
        'content',
        'content_id',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';

    public function findAll(int $limit = 0, int $offset = 0)
    {
        $this->orderBy("number ASC");
        $result = parent::findAll($limit, $offset);
        $photoModel = model("FacilityPhotoModel");

        foreach ($result as $single) {
            $single->images = $photoModel->where("facility_id", $single->id)->findAll();
        }

        return $result;
    }
}
