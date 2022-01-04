<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Mail;
use App\User;

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

    public function recuperando_clave(Request $request)
    {
        //dd($request->all());
        $user=User::where('email',$request->email)->first();
        
        if (is_null($user)) {
            
            flash('<i class="icon-circle-check"></i> El correo electrónico no se encuentra registrado, verifique!')->warning()->important();
            return redirect()->back();
            
        } else {
            
            $nombres=$user->name;
            $codigo=$this->generarCodigo();
            $nueva_clave=\Hash::make($codigo);
            $user->password=$nueva_clave;
            $user->save();
            ini_set('max_execution_time', 360); //3 minutes 
            $asunto="Bienen! | Recuperación de contraseña";
                $destinatario=$request->email;
                $r=Mail::send('auth.passwords.recuperar_clave',
                    ['nombres'=>$nombres, 'codigo' => $codigo], function ($m) use ($nombres,$asunto,$destinatario,$codigo) {
                    $m->from('info@fcrealvictoria.com.ve', 'Bienen!');
                    $m->to($destinatario)->subject($asunto);
                });
            flash('<i class="icon-circle-check"></i> Ha sido enviada a su correo su nueva contreseña!')->success()->important();
            return redirect()->back();
        }
        
    }

    protected function generarCodigo() {
     $key = '';
     $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ.!#$%:;-_?¿()[]{}';
     $max = strlen($pattern)-1;

    //Antes
        // for($i=0;$i < 8;$i++) $key .= $pattern{mt_rand(0,$max)};
    //Despues
        // for($i=0;$i < 8;$i++) $key = $pattern(mt_rand(0,$max));
    //Naturandex (Actualizado)
        for ($i = 0; $i < 4; $i++) {
            $key .= $pattern[rand(0, $max)];
        }
    //
     return $key;
    }
}
