<?php

namespace App\Controllers\Object;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;
use Exception;

class Reservations extends BaseController
{
    /**
     * @throws \ReflectionException
     */
    public function create(): RedirectResponse
    {
        $model = model("ReservationsModel");

        $data = [
                "guest_name" => $this->request->getPost("guest_name"),
                "guest_phone" => $this->request->getPost("guest_phone"),
                "guest_email" => $this->request->getPost("guest_email"),
                "check_in_date" => $this->request->getPost("check_in_date"),
                "check_out_date" => $this->request->getPost("check_out_date"),
                "total_guest" => $this->request->getPost("total_guest"),
                "total_guest_child" => $this->request->getPost("total_guest_child"),
                "special_request" => $this->request->getPost("special_request"),
                "room_slug" => $this->request->getPost("room_slug"),

                "status" => "CREATED",
        ];

        $roomModel = model("RoomsModel");
        $room = $roomModel->find($this->request->getPost("room_slug"));

        $startDate = new DateTime($this->request->getPost("check_in_date"));
        $endDate = new DateTime($this->request->getPost("check_out_date"));

        $interval = $startDate->diff($endDate);
        $totalDays = $interval->format('%a');

        $platform_fee = 0;
        $fee = ($room->price * $totalDays) + $platform_fee;

        $data["total_fee"] = $fee;

        $instance = $model->insert($data);

        // TODO: Create midtrans invoice
        // TODO: Update reservation status to invoiced
        // TODO: return invoice_url / invoice_data

        return $this->response->setJSON($instance);
    }

    public function paymentCallback()
    {
        // TODO: retrieve midtrans callback
        // TODO: retrieve reservation_id from midtrans callback
        $model = model("ReservationsModel");

        // TODO: check status. if PAID:
        $model->markPaid("x");

        // TODO: also send email to buyer

        return $this->response->setJSON([
            "msg" => "ok"
        ]);
    }

    public function getUnsynced(): ResponseInterface
    {
        // TODO: verify request header
        $model = model("ReservationsModel");
        return $this->response->setJSON($model->findUnsynced());
    }

    public function markSynced(): ResponseInterface
    {
        // TODO: verify request header
        $model = model("ReservationsModel");

        $arr = $this->request->getJSON();
        if (!array_key_exists("ids", $arr)) {
            $arr = $this->request->getPost();
        }

        $model->markAcked($arr['ids']);

        return $this->response->setJSON([
            "msg" => "ok"
        ]);
    }

}
