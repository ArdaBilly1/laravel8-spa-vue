<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function send(Request $request)
    {
        Mail::to($request->email)->send(new VerifyEmail());

        return "Email telah dikirim";
    }


    public function getList()
    {
        $response = Http::get('https://api.kirim.email/v3/list',[
                        'unix_userstamp' => '1608516987',
                        'username' => 'energeek',
                        'token' => 'y5vHLdcREt1kQsFCe2j0pfxTWV7aSgmUenergeek',
                        'generated_token' => '61770098cb589f47f0c8e937a37d0acf812f4ece4286e0c1365b251896eb9918'
                    ]);
        return $response;
    }
}



