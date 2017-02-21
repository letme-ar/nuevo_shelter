<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:users',
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'nombre_negocio' => 'required|max:255',
            'web' => 'url',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'username' => $data['username'],
            'nombre_negocio' => $data['nombre_negocio'],
            'web' => $data['web'],
            'direccion' => $data['direccion'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->type_user_id = 2;
        $user->user_creador_id = $user->id;
        $user->registration_token = str_random(20);
        $user->save();

        $url = route('confirmation',['token' => $user->registration_token]);
//        $url = route('confirmation',['token' => "123145646fds56fd56sdf565f64ds56fds564sf566f5ds"]);


//        dd($url);
        Mail::send('emails/registration',compact('user','url'),function($m) use ($user){
            $m->to($user->email,$user->nombre)->subject('Activa tu cuenta');
        });

        return $user;
   }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect(route('login'))->with('alert','Por favor, confirma tu email');
    }


    public function getConfirmation($token)
    {
        $user = User::where('registration_token',$token)->firstOrFail();
        $user->registration_token = null;
        $user->save();

        return redirect(route('login'))->with('alert','Correo confirmado, ya puedes iniciar sesión');

    }


}
