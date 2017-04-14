<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 14/04/17
 * Time: 16:45
 */

namespace App\Shelter\Mail;


use Illuminate\Support\Facades\Mail;

class ShelterMailer {

    public function sendMailWelcome($user)
    {
        $url = route('confirmation',['token' => $user->registration_token]);

        Mail::send('emails/registration',compact('user','url'),function($m) use ($user){
            $m->to($user->email,$user->nombre)->subject('Activa tu cuenta');
        });
    }
}