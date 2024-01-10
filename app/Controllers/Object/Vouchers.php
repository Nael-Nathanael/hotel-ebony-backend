<?php

namespace App\Controllers\Object;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Vouchers extends BaseController
{
    public function sync()
    {
        $model = model("VouchersModel");

        // Authorize integration key
        $header = $this->request->headers();
        if (!array_key_exists(EBONY_INTEGRATION_KEY_KEY, $header)) {
            return $this->response->setStatusCode(409)->setJSON("Please provide integration key");
        }

        if ($header[EBONY_INTEGRATION_KEY_KEY]->getValue() != EBONY_INTEGRATION_KEY) {
            return $this->response->setStatusCode(409)->setJSON("Wrong integration key");
        }

        // get json body
        $data = $this->request->getJSON();

        // container for sent ids
        $ids = [];

        foreach ($data as $datum) {
            $model->save($datum);

            // push ids to array
            $ids[] = $datum->code;
        }

        if ($ids) {
            // delete all voucher where id does not get sent from server
            $model
                ->whereNotIn("code", $ids)
                ->delete();
        }

        return $this->response->setJSON([
            "msg" => "ok"
        ]);
    }

    public function create(): RedirectResponse
    {
        $model = model("VouchersModel");
        $model->save($this->request->getPost());

        sendCalmSuccessMessage("Voucher berhasil dibuat!");
        return redirect()->route("dashboard.vouchers.index");
    }

    public function update($slug): RedirectResponse
    {
        $model = model("VouchersModel");
        $data = $this->request->getPost();
        $data['code'] = $slug;
        $model->save($data);

        sendCalmSuccessMessage("Voucher berhasil diperbarui!");
        return redirect()->route("dashboard.vouchers.index");
    }

    public function delete($slug): RedirectResponse
    {
        $model = model("VouchersModel");
        $model->delete($slug);

        sendCalmSuccessMessage("Voucher berhasil dihapus!");
        return redirect()->route("dashboard.vouchers.index");
    }

    public function get($slug): ResponseInterface
    {
        $model = model("VouchersModel");
        return $this->response->setJSON($model->find($slug));
    }

    public function get_all(): ResponseInterface
    {
        // Authorize integration key
        $header = $this->request->headers();
        if (!array_key_exists(EBONY_INTEGRATION_KEY_KEY, $header)) {
            return $this->response->setStatusCode(409)->setJSON("Please provide integration key");
        }

        if ($header[EBONY_INTEGRATION_KEY_KEY]->getValue() != EBONY_INTEGRATION_KEY) {
            return $this->response->setStatusCode(409)->setJSON("Wrong integration key");
        }

        $model = model("VouchersModel");
        return $this->response->setJSON($model->findAll());
    }
}
