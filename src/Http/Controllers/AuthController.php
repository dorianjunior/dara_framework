<?php

namespace App\Http\Controllers;

use App\Core\View;

class AuthController {
  public function login($request) {
    return View::render('auth/login');
  }
}
