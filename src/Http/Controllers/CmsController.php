<?php

namespace App\Http\Controllers;

use App\Core\View;

class CmsController {
  public function dashboard($request) {
    return View::render('cms/dashboard');
  }
}
