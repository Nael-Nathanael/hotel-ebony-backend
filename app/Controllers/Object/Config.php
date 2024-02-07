<?php

namespace App\Controllers\Object;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class Config extends BaseController
{
    public function update()
    {
        $model = model("Config");
        $post = $this->request->getPost();

        foreach ($post as $key => $value) {
            $model->save(
                [
                    "key" => $key,
                    "value" => $value
                ]
            );
        }

        return redirect()->to(previous_url());
    }

    public function getByKey($key): ResponseInterface
    {
        $model = model("Config");
        return $this->response->setJSON(
            [
                $key => $model->findOrDefault($key, "0")
            ]
        );
    }
}
