<?php

namespace App\Models;

use CodeIgniter\Model;

class Config extends Model
{
    protected $table = 'config';
    protected $primaryKey = 'key';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['key', 'value'];

    protected $useTimestamps = false;

    function findOrDefault($key, $default)
    {
        $target = $this->find($key);
        if ($target) {
            return $target->value;
        }

        return $default;
    }
}
