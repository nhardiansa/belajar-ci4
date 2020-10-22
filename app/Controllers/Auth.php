<?php

namespace App\Controllers;

use \App\Models\AuthModel;

class Auth extends BaseController
{

    protected $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function register()
    {
        $data = [
            "title" => "Daftar Masuk",
            "validation" => \Config\Services::validation()
        ];

        return view("auth/register", $data);
    }

    public function signup()
    {
        if (!$this->validate([
            "nama" => [
                "rules" => "required|alpha|min_length[5]",
                "errors" => [
                    "required" => "{field} harus diisi",
                    "alpha" => "masukkan input yang valid",
                    "min_length" => "input yang dimasukkan terlalu pendek"
                ]
            ],
            "email" => [
                "rules" => "required|valid_email|is_unique[auth.email]",
                "errors" => [
                    "required" => "{field} harus diisi",
                    "valid_email" => "{field} yang anda masukkan tidak valid",
                    "is_unique" => "{field} yang anda masukkan telah terdaftar"
                ]
            ],
            "password" => [
                "rules" => "required|min_length[8]",
                "errors" => [
                    "required" => "{field} harus diisi",
                    "min_length" => "{field} anda terlalu pendek"
                ]
            ]
        ])) {
            return redirect()->to("/auth/register")->withInput();
        }


        $nama = $this->request->getVar("nama");
        $email = $this->request->getVar("email");
        $password = $this->request->getVar("password");

        $password = password_hash($password, PASSWORD_ARGON2I);

        $data = [
            "nama" => $nama,
            "email" => $email,
            "password" => $password
        ];

        $this->authModel->save($data);

        return redirect()->to("/auth/register");
    }

    public function login()
    {
        $data = [
            "title" => "Login User",
            "validation" => \Config\Services::validation()
        ];

        return view("auth/login", $data);
    }

    public function signin()
    {
        if (!$this->validate([
            "email" => [
                "rules" => "required|valid_email",
                "errors" => [
                    "required" => "{field} harus diisi",
                    "valid_email" => "{field} yang anda masukkan tidak valid",
                ]
            ],
            "password" => [
                "rules" => "required",
                "errors" => [
                    "required" => "{field} harus diisi"
                ]
            ]
        ])) {
            return redirect()->to("/auth/login")->withInput();
        }

        $email = $this->request->getVar("email");
        $password = $this->request->getVar("password");

        if ($this->authModel->getLogin($email, $password)) {
            return redirect()->to("/auth/login");
            // echo "berhasil";
        } else {
            // echo "gagal";
            session()->setFlashdata("error", "Email atau Password salah");
            return redirect()->to("/auth/login")->withInput();
        }
    }
}
