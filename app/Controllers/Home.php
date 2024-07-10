<?php

namespace App\Controllers;

class Home extends BaseController
{
  public function landing()
  {
    $data['title'] = 'Landing';
    return view('partials/header', $data) .
      view('landing');
  }
}
