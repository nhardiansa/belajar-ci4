<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "user";
    protected $useTimestamps = true;
    protected $allowedFields = ["nama", "alamat"];

    public function search($keyword)
    {
        return $this->table($this->table)->like('nama', $keyword)->orLike('alamat', $keyword);
    }
}
