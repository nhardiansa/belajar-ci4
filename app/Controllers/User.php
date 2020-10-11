<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class User extends Controller
{
    public function index()
    {
        $data = [
            "title" => "User Page"
        ];

        return view("user/index", $data);
    }
}
