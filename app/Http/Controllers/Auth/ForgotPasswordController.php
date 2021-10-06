<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\Kategori;
use App\Models\Artikel;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    public function showLinkRequestForm()
    {
        $kategori=Kategori::latest()->get();
        $artikel=Artikel::latest()->limit(2)->get();
        return view('auth.passwords.email',compact(['kategori','artikel']));
    }
}
