<?php

namespace App\Controllers;

use \App\Models\LoginModel;

class Login extends BaseController
{
    protected $login;

    public function __construct()
    {
        $this->login = new LoginModel();
    }

    public function index()
    {
        $data = [
            "title" => "Login Page",
            "validation" => \Config\Services::validation()
        ];
        return view('login/index', $data);
    }

    public function verify()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        if (!$this->validate([
            "email" => [
                "rules" => "required|valid_email",
                "errors" => [
                    "valid_email" => "Masukkan {field} yang valid",
                    "required" => "Masukan {field} terlebih dahulu"
                ]
            ]
        ])) {
            return redirect()->to("/login")->withInput();
        }


        if ($this->login->emailCheck($email)) {

            $this->login->passTempCheck($password);
            return redirect()->to("/");
        } else {
            session()->setFlashdata("error_login", "Email yang anda masukkan belum terdaftar");
            return redirect()->to("/login");
        }
    }
}
