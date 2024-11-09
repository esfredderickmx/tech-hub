<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Session;

class AuthenticationController extends Controller {
  public function signOut() {
    Auth::logout();

    Session::invalidate();
    Session::regenerateToken();
    Session::put('toast_message', ['type' => 'info', 'message' => 'Sesión finalizada correctamente.']);

    return Redirect::intended();
  }
}
