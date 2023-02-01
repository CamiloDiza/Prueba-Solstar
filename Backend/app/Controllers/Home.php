<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('../../../Frontend/views/show_singers.php');
    }
}
