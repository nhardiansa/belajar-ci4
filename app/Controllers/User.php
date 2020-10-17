<?php

namespace App\Controllers;

use \App\Models\UserModel;

class User extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            "title" => "User Page",
            "user" => $this->userModel->getUser()
        ];

        return view("user/index", $data);
    }
}
