<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\Kategori;
use App\Models\Artikel;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    public function showResetForm(Request $request,$token)
    {
        $email=$request->get('email');
        $kategori=Kategori::latest()->get();
        $artikel=Artikel::latest()->limit(2)->get();
        return view('auth.passwords.reset',compact(['kategori','artikel','token','email']));
    }
}
