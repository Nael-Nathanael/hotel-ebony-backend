<?php

namespace App\Controllers\Object;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class Reservations extends BaseController
{
    /**
     * @throws \ReflectionException
     */
    public function create()
    {
        $model = model("ReservationsModel");

        $request_body = $this->request->getJSON();

        /* Base Data */
        $data = [
            "guest_name" => $request_body->guest_name,
            "guest_phone" => $request_body->guest_phone,
            "guest_email" => $request_body->guest_email,

            "special_request" => $request_body->special_request,
            "bed_type" => $request_body->bed_type,

            "check_in_date" => $request_body->check_in_date,
            "check_out_date" => $request_body->check_out_date,
            "total_guest" => $request_body->total_guest,
            "total_guest_child" => $request_body->total_guest_child,

            "room_slug" => $request_body->room_slug,
            "room_count" => intval($request_body->room_count),

            "total_fee" => 0,

            "status" => "CREATED",
        ];
        /* Base Data perlu dilengkapi dengan: reservation_id, invoice_url, total_fee, rate_code */

        /* Get Instance */
        $roomModel = model("RoomsModel");
        $room = $roomModel->findCompleteWithFilter([
            "slug" => $request_body->room_slug,
            "s" => $request_body->check_in_date,
            "e" => $request_body->check_out_date,
            "c" => $request_body->room_count,
        ]);

        /* If not found, return */
        if (count($room) == 0) {
            return $this->response->setJSON([
                "msg" => "Room pilihan anda tidak ditemukan"
            ]);
        }
        $room = $room[0];

        /* If not available, return */
        if (count($room->availabilities) == 0) {
            return $this->response->setJSON([
                "msg" => "Room pilihan anda sudah tidak tersedia"
            ]);
        }

        /* Generate reservation_id */
        $data["reservation_id"] = "EBONY-" . time();
        while ($model->find($data["reservation_id"])) {
            sleep(.1);
            $data["reservation_id"] = "EBONY-" . time();
        }

        /* Generate total_fee and rate_code */
        foreach ($room->availabilities as $availability) {
            if ($availability->price && intval($availability->price) > 0) {
                $data["total_fee"] += intval($availability->price);
            } else {
                $data["total_fee"] += intval($room->price);
            }

            if ($availability->rate_code) {
                $data["rate_code"] = $availability->rate_code;
            } else {
                $data["rate_code"] = $room->rate_code;
            }
        }

        $data["total_fee"] *= intval($data["room_count"]);

        $instance = $model->insert($data);
        $instance = $model->find($instance);

        // Access custom variable
        $midtrans_production_mode = getenv('MIDTRANS_MODE') == "PRODUCTION";
        $transaction_notif_url = getenv('RECEIVE_TRANSACTION_URL');
        $server_key = getenv('MIDTRANS_SERVER_KEY');
        $afterpayment_redirect = getenv('AFTERPAYMENT_REDIRECT');

        Config::$serverKey = $server_key;
        Config::$isProduction = $midtrans_production_mode;
        Config::$overrideNotifUrl = $transaction_notif_url;

        // Generate params for transaction
        $guest_name_exp = explode(" ", $instance->guest_name);
        if (count($guest_name_exp) == 1) {
            $first_name = $instance->guest_name;
            $last_name = $instance->guest_name;
        } else {
            $first_name = implode(" ", array_slice($guest_name_exp, 0, count($guest_name_exp) - 1));
            $last_name = end($guest_name_exp);
        }

        $params = [
            "transaction_details" => [
                "order_id" => $instance->reservation_id,
                "gross_amount" => $instance->total_fee
            ],
            "customer_details" => [
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email" => $instance->guest_email
            ],
            "item_details" => [],
            "callbacks" => [
                "finish" => $afterpayment_redirect . "/$instance->reservation_id"
            ]
        ];

        if ($instance->guest_phone) {
            $params["customer_details"]["phone"] = $instance->guest_phone;
        }

        foreach ($room->availabilities as $availability) {
            $startDate = $availability->date;
            $endDate = date("Y-m-d", strtotime($startDate . " +1 days"));
            $params["item_details"][] = [
                "id" => $availability->id,
                "price" => ($availability->price && intval($availability->price) > 0) ? $availability->price : $room->price,
                "quantity" => $instance->room_count,
                "name" => "Stay at $room->name ($startDate to $endDate)"
            ];
        }

        $snapToken = Snap::getSnapToken($params);

        $instance->invoice_url = $snapToken;
        $instance->status = "INVOICED";
        $model->save($instance);

        return $this->response->setJSON(
            $model->find($instance->reservation_id)
        );
    }

    public function receiveMidtransNotification(): ResponseInterface
    {
        $reservationModel = model("ReservationsModel");

        $midtrans_status = $this->request->getJSON();
        if ($midtrans_status->transaction_status == "settlement" || $midtrans_status->transaction_status == "capture") {
            $reservationModel->where("reservation_id", $midtrans_status->order_id)
                ->set('paid_at', 'NOW()', false)
                ->set('status', 'PAID')
                ->update();

            return $this->response->setJSON([
                "msg" => "ok, settlement"
            ]);
        }

        // TODO: Send invoice to buyer
        // TODO: Send invoice to Ebony

        return $this->response->setJSON([
            "msg" => "ok, not settled yet"
        ]);
    }

    public function get(): ResponseInterface
    {
        // Authorize integration key
        $header = $this->request->headers();
        if (!array_key_exists(EBONY_INTEGRATION_KEY_KEY, $header)) {
            return $this->response->setStatusCode(409)->setJSON("Please provide integration key");
        }

        if ($header[EBONY_INTEGRATION_KEY_KEY]->getValue() != EBONY_INTEGRATION_KEY) {
            return $this->response->setStatusCode(409)->setJSON("Wrong integration key");
        }

        $model = model("ReservationsModel");
        return $this->response->setJSON($model->findAll());
    }

    public function getById($id): ResponseInterface
    {
        $reservationModel = model("ReservationsModel");
        $instance = $reservationModel->find($id);
        $model = model("RoomsModel");

        $instance->room = $model->findCompleteWithFilter([
            "slug" => $instance->room_slug
        ])[0];

        $midtrans_production_mode = getenv('MIDTRANS_MODE') == "PRODUCTION";
        $server_key = getenv('MIDTRANS_SERVER_KEY');

        Config::$serverKey = $server_key;
        Config::$isProduction = $midtrans_production_mode;

        $transaction_status = Transaction::status($id);
        $instance->midtrans_status = $transaction_status;

        if ($instance->midtrans_status) {
            if ($instance->midtrans_status->transaction_status == "settlement") {
                $reservationModel->where("reservation_id", $id)
                    ->set('paid_at', 'NOW()', false)
                    ->set('status', 'PAID')
                    ->update();
            }
        }

        return $this->response->setJSON($instance);
    }

    public function getNew(): ResponseInterface
    {
        // Authorize integration key
        $header = $this->request->headers();
        if (!array_key_exists(EBONY_INTEGRATION_KEY_KEY, $header)) {
            return $this->response->setStatusCode(409)->setJSON("Please provide integration key");
        }

        if ($header[EBONY_INTEGRATION_KEY_KEY]->getValue() != EBONY_INTEGRATION_KEY) {
            return $this->response->setStatusCode(409)->setJSON("Wrong integration key");
        }

        $model = model("ReservationsModel");
        return $this->response->setJSON($model->findUnsynced());
    }

    public function ack(): ResponseInterface
    {
        // Authorize integration key
        $header = $this->request->headers();
        if (!array_key_exists(EBONY_INTEGRATION_KEY_KEY, $header)) {
            return $this->response->setStatusCode(409)->setJSON("Please provide integration key");
        }

        if ($header[EBONY_INTEGRATION_KEY_KEY]->getValue() != EBONY_INTEGRATION_KEY) {
            return $this->response->setStatusCode(409)->setJSON("Wrong integration key");
        }

        $model = model("ReservationsModel");

        $arr = $this->request->getJSON();

        $model->markAcked($arr);

        return $this->response->setJSON([
            "msg" => "ok"
        ]);
    }

}
