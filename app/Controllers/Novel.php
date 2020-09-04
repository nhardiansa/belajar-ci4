<?php

namespace App\Controllers;

use \App\Models\NovelModel;
use Config\Services;

class Novel extends BaseController
{
    protected $novel;

    public function __construct()
    {
        $this->novel = new NovelModel();
    }

    public function index()
    {
        $data = [
            "title" => "Novel",
            "komik" => $this->novel->getNovel()
        ];

        return view("novel/index", $data);
    }

    public function detail($slug)
    {
        $data = [
            "title" => "Detail Novel",
            "detail" => $this->novel->getNovel($slug)
        ];


        return view("novel/detail", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Novel",
            "validation" => \Config\Services::validation()
        ];

        return view("novel/create", $data);
    }

    public function save()
    {
        // Validation The Data

        if (!$this->validate([
            "judul" => [
                "rules" => "required|is_unique[novel.judul]",
                "errors" => [
                    "is_unique" => "{field} novel sudah terdaftar",
                    "required" => "Masukan {field} novel terlebih dahulu"
                ]
            ],
            "penulis" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Masukan nama {field}"
                ]
            ],
            "penerbit" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Masukan nama {field}"
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to("/novel/create")->withInput()->with("validation", $validation);
        }

        $slug = url_title($this->request->getVar("judul"), '-', true);

        $data = [
            "judul" => $this->request->getVar("judul"),
            "slug" => $slug,
            "penulis" => $this->request->getVar("penulis"),
            "penerbit" => $this->request->getVar("penerbit"),
            "sampul" => $this->request->getVar("sampul"),
        ];

        $this->novel->save($data);

        session()->setFlashdata('pesan', 'Novel Berhasil Ditambahkan');

        return redirect()->to('/novel');
    }

    public function delete($id)
    {
        $this->novel->delete($id);

        session()->setFlashdata('pesan', 'Novel Berhasil Dihapus');
        return redirect()->to('/novel');
    }
}
