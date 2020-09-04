<?php

namespace App\Controllers;

class Pages extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Homepage'
		];
		return view('pages/home', $data);
	}

	public function about()
	{
		$data = [
			'title' => 'About Page'
		];
		return view('pages/about', $data);
	}

	//--------------------------------------------------------------------

}
