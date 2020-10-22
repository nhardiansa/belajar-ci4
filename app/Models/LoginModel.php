<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = "login";
    protected $useTimestamps = true;
    protected $allowedFields = ["email", "password"];

    public function emailCheck($email)
    {
        if ($this->where("email", $email)->first() === null) {
            return false;
        } else {
            return true;
        }
    }

    public function passTempCheck($pass)
    {
        if ($this->where("password", $pass)->first() === null) {
            return false;
        } else {
            return true;
        }
    }
}
