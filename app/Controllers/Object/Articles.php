<?php

namespace App\Controllers\Object;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Articles extends BaseController
{
    public function create(): RedirectResponse
    {
        $articles = model("ArticlesModel");

        $slug = url_title($this->request->getPost("title"));
        $finalSlug = $slug;
        $counter = 1;
        while ($articles->find($finalSlug)) {
            $finalSlug = $slug . "-" . $counter++;
        }

        // upload image
        $imgUrl = PLACEHOLDER_IMG;
        if ($_FILES["coverImage"]["name"]) {
            $path = $this->request->getFile("coverImage");
            $path->move(UPLOAD_FOLDER_URL);
            $imgUrl = base_url("/uploads/" . $path->getName());
        }

        $articles->insert(
            [
                "imgUrl" => $imgUrl,
                "slug" => $finalSlug,
                "title" => $this->request->getPost("title"),
                "topic" => $this->request->getPost("topic"),
                "tag" => $this->request->getPost("tag"),
                "short_description" => $this->request->getPost("short_description"),
                "content" => $this->request->getPost("content"),
                "service" => $this->request->getPost("service"),
                "keywords" => $this->request->getPost("keywords"),
                "meta_title" => $this->request->getPost("meta_title"),
                "meta_description" => $this->request->getPost("meta_description"),
            ]
        );

        return redirect()->to(previous_url());
    }

    public function update($slug): RedirectResponse
    {
        $articles = model("ArticlesModel");

        $data = [
            "slug" => $slug,
            "title" => $this->request->getPost("title"),
            "topic" => $this->request->getPost("topic"),
            "tag" => $this->request->getPost("tag"),
            "short_description" => $this->request->getPost("short_description"),
            "content" => $this->request->getPost("content"),
            "service" => $this->request->getPost("service"),
            "keywords" => $this->request->getPost("keywords"),
            "meta_title" => $this->request->getPost("meta_title"),
            "meta_description" => $this->request->getPost("meta_description"),
        ];

        // upload image
        if ($_FILES["coverImage"]["name"]) {
            $isUploaded = false;
            $try_count = 1;

            while (!$isUploaded && $try_count < 3) {
                try {
                    $path = $this->request->getFile("coverImage");
                    $path->move(UPLOAD_FOLDER_URL);
                    $data['imgUrl'] = base_url("/uploads/" . $path->getName());
                    $isUploaded = true;
                } catch (Exception $e) {
                    $try_count++;
                }
            }

            if (!$isUploaded) {
                sendCalmSuccessMessage("We update the article, but cover image failed to be uploaded");
            }
        }

        $articles->save($data);

        return redirect()->to(previous_url());
    }


    public function delete($slug): RedirectResponse
    {
        $articles = model("ArticlesModel");

        $articles->delete($slug);

        return redirect()->to(previous_url());
    }

    public function get($slug = false): ResponseInterface
    {
        $articles = model("ArticlesModel");
        if (!$slug) {
            $articles_all = $articles
                ->orderBy("created_at DESC")
                ->findAll();

            $excluded_field = 'content';
            foreach ($articles_all as &$article) {
                unset($article->$excluded_field);
            }
            return $this->response->setJSON($articles_all);
        }
        return $this->response->setJSON($articles->find($slug));
    }
}
