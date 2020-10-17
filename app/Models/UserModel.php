<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "user";
    protected $useTimestamps = true;
    protected $allowedFields = ["nama", "alamat"];

    public function getUser()
    {
        return $this->findAll();
    }
}
