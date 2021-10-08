<?php

namespace App\Controllers\Object;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class Webinars extends BaseController
{
    public function create(): RedirectResponse
    {
        $webinars = model("Webinars");
        $webinars->save(
            [
                "title" => $this->request->getPost("title"),
                "datetime" => $this->request->getPost("datetime"),
                "description" => $this->request->getPost("description"),
                "url" => $this->request->getPost("url"),
            ]
        );
        return redirect()->to(previous_url());
    }

    public function get(): ResponseInterface
    {
        $webinars = model("Webinars");
        $presenters = model("Presenters");

        $allWebinar = $webinars->orderBy("datetime DESC")->limit(10)->findAll();
        foreach ($allWebinar as $webinar) {
            $webinar->presenters = $presenters->where("webinar_id", $webinar->id)->findAll();
        }

        return $this->response->setJSON($allWebinar);
    }
}
