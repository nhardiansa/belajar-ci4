<?php

namespace App\Controllers;

use \App\Models\NovelModel;
use Config\Services;

class Novel extends BaseController
{
    protected $novelModel;

    public function __construct()
    {
        $this->novelModel = new NovelModel();
    }

    public function index()
    {
        $data = [
            "title" => "Novel",
            "komik" => $this->novelModel->getNovel()
        ];

        return view("novel/index", $data);
    }

    public function detail($slug)
    {
        $data = [
            "title" => "Detail Novel",
            "detail" => $this->novelModel->getNovel($slug)
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

        $this->novelModel->save($data);

        session()->setFlashdata('pesan', 'Novel Berhasil Ditambahkan');

        return redirect()->to('/novel');
    }

    public function delete($id)
    {
        $this->novelModel->delete($id);

        session()->setFlashdata('pesan', 'Novel Berhasil Dihapus');
        return redirect()->to('/novel');
    }

    public function edit($slug)
    {
        $data = [
            "title" => "Tambah Novel",
            "validation" => \Config\Services::validation(),
            "komik" => $this->novelModel->getNovel($slug)
        ];

        return view("novel/edit", $data);
    }

    public function update($id)
    {
        // Pengechekan input
        $oldNovel = $this->novelModel->getNovel($this->request->getVar('slug'));

        if ($oldNovel['judul'] === $this->request->getVar('judul')) {
            $rule_judul = "required";
        } else {
            $rule_judul = "required|is_unique[novel.judul]";
        }

        // Validasi Input
        if (!$this->validate([
            "judul" => [
                "rules" => $rule_judul,
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
            return redirect()->to("/novel/edit/" . $this->request->getVar('slug'))->withInput()->with("validation", $validation);
        }

        // Input Data

        $slug = url_title($this->request->getVar("judul"), '-', true);

        $data = [
            "id" => $id,
            "judul" => $this->request->getVar("judul"),
            "slug" => $slug,
            "penulis" => $this->request->getVar("penulis"),
            "penerbit" => $this->request->getVar("penerbit"),
            "sampul" => $this->request->getVar("sampul"),
        ];

        $this->novelModel->save($data);

        session()->setFlashdata('pesan', 'Novel Berhasil Diubah');

        return redirect()->to('/novel');
    }
}
