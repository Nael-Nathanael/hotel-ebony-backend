<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationsModel extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'reservation_id';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'reservation_id',
        'guest_name',
        'guest_phone',
        'guest_email',
        'check_in_date',
        'check_out_date',
        'total_guest',
        'total_guest_child',
        'status',
        'special_request',
        'room_slug',
        'invoice_url',
        'created_at',
        'updated_at',
        'acked_at',
        'voucher_no',
        'total_fee',
        'paid_at',
        'bed_type',
        'rate_code',
        'room_count',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function findUnsynced()
    {
        $this
            ->where("acked_at is null", null, FALSE)
            ->where("paid_at is NOT NULL", null, FALSE);
        return parent::findAll();
    }

    public function findAll(int $limit = 0, int $offset = 0)
    {
        $this->orderBy("created_at", "DESC");
        $result = parent::findAll($limit, $offset);
        $room_model = model("RoomsModel");
        foreach ($result as $res) {
            $res->room = $room_model->find($res->room_slug);
        }

        return $result;
    }

    public function markAcked($idArray)
    {
        $this->whereIn("reservation_id", $idArray)
            ->set('acked_at', 'NOW()', false)
            ->update();
    }

    public function markPaid($id)
    {
        $this->where("reservation_id", $id)
            ->set('paid_at', 'NOW()', false)
            ->update();
    }
}
