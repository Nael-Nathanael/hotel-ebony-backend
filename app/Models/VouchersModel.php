<?php

namespace App\Models;

use CodeIgniter\Model;

class VouchersModel extends Model
{
    protected $table = 'vouchers';
    protected $primaryKey = 'code';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'code',
        'price_reduction',
        'description',
    ];

    // Dates
    protected $useTimestamps = false;
}
