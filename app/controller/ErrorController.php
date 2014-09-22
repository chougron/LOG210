<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;

class ErrorController extends Controller{
    public function error404(){
        return View::render("error/error404.php");
    }
}