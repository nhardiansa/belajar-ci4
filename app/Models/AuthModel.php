<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = "auth";
    protected $useTimestamps = true;
    protected $allowedFields = ["nama", "email", "password"];

    public function getLogin($email, $password)
    {
        session();
        $data = $this->where("email", $email)->first();

        if ($data === null) {
            return false;
        } else {
            if (password_verify($password, $data["password"])) {
                session()->set([
                    "email" => $email,
                    "nama" => $data["nama"],
                    "logged_in" => true
                ]);

                return true;
            } else {
                return false;
            }
        }
    }
}
