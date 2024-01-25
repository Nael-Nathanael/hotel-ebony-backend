<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticlesModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'slug';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'slug',
        'title',
        'tag',
        'short_description',
        'content',
        'imgUrl',
        "keywords",
        "meta_title",
        "meta_description",

        'title_id',
        'tag_id',
        'short_description_id',
        'content_id',
        'imgUrl_id',
        "keywords_id",
        "meta_title_id",
        "meta_description_id",
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
