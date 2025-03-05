<?php

namespace App\Http\Controllers;

use App\Core\View;

class HomeController {
  public function index($request) {
    return "View::render('home');";
  }
}
