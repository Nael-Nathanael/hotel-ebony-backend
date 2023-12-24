<?php

namespace App\Models;

use CodeIgniter\Model;

class Lines extends Model
{
    protected $table = 'lines';
    protected $primaryKey = 'key';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['group_name', 'key', 'value'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    function findOrEmptyString($key): string
    {
        $lang = session()->get('LANG');

        if ($lang) {
            $langkey = "$lang$key";
            $target = $this->find($langkey);
            if ($target) {
                return $target->value;
            }

            $target = $this->find($key);
            if ($target) {
                // Create
                $this->save([
                    "group_name" => $target->group_name,
                    "key" => $langkey,
                    "value" => $target->value,
                ]);
                return $this->findOrEmptyString($key);
            }
            return "";
        }

        $target = $this->find($key);
        if ($target) {
            return $target->value;
        }

        // If string starts with EN_ and is not found, return the value without EN_
        if (substr($key, 0, 3) === "EN_") {
            $subkey = substr($key, 3);
            $target = $this->find($subkey);
            if ($target) {
                // Create
                $this->save([
                    "group_name" => $target->group_name,
                    "key" => $key,
                    "value" => $target->value,
                ]);
                return $this->findOrEmptyString($key);
            };
        }

        return '';
    }

    function findOrPlaceholderImage($key): string
    {
        $target = $this->find($key);
        if (!$target) {
            return 'https://placehold.co/500?text=1920x1080';
        }
        return $target->value;
    }
}
