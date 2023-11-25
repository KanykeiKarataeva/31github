<?php

namespace App\Http\Controllers;

use App\Mail\SendResetPasswordLink;
use App\Services\UpdatePassword;
use App\Services\UpdatePasswordService;
use App\Services\VerificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;

class ResetPasswordController extends Controller
{
    private $service;
    public function __construct()
    {
        $this->service = new UpdatePasswordService();
    }
    public function form(){
        return view('resetPassword');
    }

    public function sendLink(Request $request){
        $email = $request->email;
        Mail::to($email)->send(new SendResetPasswordLink($email));

        return redirect()->route('index')->with('msg', 'We have sent a link to reset your password to your email.');
    }

    public function changePassword(string $email){
        return view('changePasswordForm', compact('email'));
    }

    public function updatePassword(Request $request):Response
    {
        return $this->service->updatePassword($request);
    }
}
