<?php

namespace App\Controllers\Object;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Galleries extends BaseController
{
    public function create(): RedirectResponse
    {
        $model = model("GalleryAlbumModel");

        $slug = strtolower($this->request->getPost("title"));
        $finalSlug = $slug;
        $counter = 1;
        while ($model->find($finalSlug)) {
            $finalSlug = $slug . "-" . $counter++;
        }

        $data = [
            "slug" => $finalSlug,
            "title" => $this->request->getPost("title")
        ];

        $model->save($data);

        sendCalmSuccessMessage("Album berhasil didaftarkan!");
        return redirect()->route("dashboard.galleries.index");
    }

    public function photos($albumSlug): RedirectResponse
    {
        $model = model("GalleryPhotoModel");

        if ($_FILES["img"]["name"]) {
            $path = $this->request->getFile("img");
            $path->move(UPLOAD_FOLDER_URL);
            $imgUrl = base_url("/uploads/" . $path->getName());
            $model->save([
                "album_slug" => $albumSlug,
                "url" => $imgUrl
            ]);
        } else {
            sendCalmErrorMessage("Foto gagal di-upload");
            return redirect()->back();
        }


        sendCalmSuccessMessage("Foto berhasil diupload!");
        return redirect()->back();
    }

    public function photoDelete($photoId): RedirectResponse
    {
        $model = model("GalleryPhotoModel");

        $model->delete($photoId);

        sendCalmSuccessMessage("Foto berhasil dihapus!");
        return redirect()->back();
    }

    public function update($slug): RedirectResponse
    {
        $model = model("GalleryAlbumModel");

        $_POST["slug"] = $slug;
        $model->save($_POST);

        sendCalmSuccessMessage("Album berhasil diperbarui!");
        return redirect()->route("dashboard.galleries.index");
    }

    public function delete($id): RedirectResponse
    {
        $model = model("GalleryAlbumModel");

        $model->delete($id);

        sendCalmSuccessMessage("Album berhasil dihapus!");
        return redirect()->route("dashboard.galleries.index");
    }

    public function get(): ResponseInterface
    {
        $model = model("GalleryAlbumModel");
        $modelPhoto = model("GalleryPhotoModel");

        $instances = $model->orderBy("createdAt", "ASC")->findAll();

        foreach ($instances as $instance) {
            $instance->photos = $modelPhoto->where("album_slug", $instance->slug)->orderBy("createdAt", "ASC")->findAll();
        }

        return $this->response->setJSON($instances);
    }
}
