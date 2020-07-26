<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntroController extends Controller
{
    public function getIntro()
    {
      	return redirect() -> action('RetoController@getRetos');
    }
}
