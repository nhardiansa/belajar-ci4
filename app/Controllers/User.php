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
        if ($this->request->getVar('page_user')) {
            $currentPage = $this->request->getVar();
        } else {
            $currentPage = ['page_user' => '1'];
        }

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $user = $this->userModel->search($keyword);
        } else {
            $user = $this->userModel;
        }

        $data = [
            "title"       => "User Page",
            "user"        => $user->paginate(10, 'user'),
            "pager"       => $this->userModel->pager,
            "currentPage" => $currentPage
        ];

        return view("user/index", $data);
    }
}
