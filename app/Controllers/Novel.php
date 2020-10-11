<?php

namespace App\Controllers;

use \App\Models\NovelModel;

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
            ],
            "sampul" => [
                "rules" => "max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]",
                "errors" => [
                    "max_size" => "Ukuran {field} terlalu besar (maksimal ukuran 2MB)",
                    "is_image" => "Yang anda pilih bukan gambar",
                    "mime_in" => "Yang anda pilih bukan gambar"
                ]
            ]
        ])) {
            return redirect()->to("/novel/create")->withInput();
        }

        // kelola gambar
        $fileSampul = $this->request->getFile("sampul");

        if ($fileSampul->getError() === 4) {

            $namaSampul = "default.jpg";
        } else {
            // generate nama random
            $namaSampul = $fileSampul->getRandomName();

            // memindahkan sampul ke folder img
            $fileSampul->move("img", $namaSampul);
        }

        $slug = url_title($this->request->getVar("judul"), '-', true);

        $data = [
            "judul" => $this->request->getVar("judul"),
            "slug" => $slug,
            "penulis" => $this->request->getVar("penulis"),
            "penerbit" => $this->request->getVar("penerbit"),
            "sampul" => $namaSampul
        ];

        $this->novelModel->save($data);

        session()->setFlashdata('pesan', 'Novel Berhasil Ditambahkan');

        return redirect()->to('/novel');
    }

    public function delete($id)
    {
        // mendapatkan nama file
        $namaSampul = $this->novelModel->find($id);
        $namaSampul = $namaSampul['sampul'];
        // dd($namaSampul);

        if ($namaSampul !== "default.jpg") {
            //menghapus gambar
            unlink("img/" . $namaSampul);
        }


        $this->novelModel->delete($id);

        session()->setFlashdata('pesan', 'Novel Berhasil Dihapus');
        return redirect()->to('/novel');
    }

    public function edit($slug)
    {
        $data = [
            "title" => "Tambah Novel",
            "validation" => \Config\Services::validation(),
            "novel" => $this->novelModel->getNovel($slug)
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
            ],
            "sampul" => [
                "rules" => "max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]",
                "errors" => [
                    "max_size" => "Ukuran {field} terlalu besar (maksimal ukuran 2MB)",
                    "is_image" => "Yang anda pilih bukan gambar",
                    "mime_in" => "Yang anda pilih bukan gambar"
                ]
            ]
        ])) {
            return redirect()->to("/novel/edit/" . $this->request->getVar('slug'))->withInput();
        }

        $sampulInput = $this->request->getFile('sampul');
        $sampulLama = $this->request->getVar('sampulLama');

        if ($sampulInput->getError() === 4) {
            $sampul = $sampulLama;
        } else {

            // generate nama random
            $sampul = $sampulInput->getRandomName();
            // pindahkan sampul ke folder img
            $sampulInput->move('img', $sampul);
            // hapus gambar sampul yang lama
            unlink("img/" . $sampulLama);
        }

        // Input Data

        $slug = url_title($this->request->getVar("judul"), '-', true);

        $data = [
            "id" => $id,
            "judul" => $this->request->getVar("judul"),
            "slug" => $slug,
            "penulis" => $this->request->getVar("penulis"),
            "penerbit" => $this->request->getVar("penerbit"),
            "sampul" => $sampul
        ];

        $this->novelModel->save($data);

        session()->setFlashdata('pesan', 'Novel Berhasil Diubah');

        return redirect()->to('/novel');
    }
}
