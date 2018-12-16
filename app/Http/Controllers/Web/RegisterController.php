<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Mail;
use App\Mail\RegisterConfirmed;
use App\Mail\RecuperatePass;



class RegisterController extends Controller
{
     public function index(Request $request){
   		$messages=[
            'name.required'=>'El campo nombre es requerido',
            'name.string'=>'El campo nombre solo admite letras',
            'last_name.required'=>'El campo apellido es requerido',
            'last_name.string'=>'El campo apellido solo admite letras',
   			'username.required'=>'El campo usuario es requerido',
   			'username.string'=>'El campo usuario solo admite valores alfanumericos',
   			'username.unique'=>'El usuario ingresado ya existe',
   			'email.required'=>'El campo email es requerido',
   			'email.string'=>'El campo email solo admite valores alfanumericos',
   			'email.unique'=>'El email ingresado ya existe',
            'password.required' => 'El campo password es requerido',
   			'password.confirmed' => 'El password no coincide '
   		];

   		$this->validate($request,[
            'name'=>'required|string',
            'last_name'=>'required|string',
   			'username' =>'required|string|unique:users',
   			'email'    =>'required|string|unique:users',
   			'password' =>'required|string|confirmed',
   		],$messages);

         $user=new User();
         $user->name=$request->name;
         $user->last_name=$request->last_name;
         $user->username=$request->username;
         $user->email=$request->email;
         $user->password=$request->password;
         $user->confirmed=0;
         $user->save();

         Mail::to($request->email)->send(new RegisterConfirmed($user));

         return redirect()->route('login')->with('success','Registro realizado con exito, se ha enviado un mensaje a su correo para confirmar su cuenta');
   }  

   public function RegisterConfirmed($id){
      $user = User::find($id);
      $user->confirmed = 1;
      $user->save();
      return redirect()->route('login')->with('success',"Cuenta confirmada con exito, Inicia Sesión para disfrutar de Widelip");
   }

   public function restore(Request $request){
      
      $messages=[
         'email.required'=>'El campo correo electronico es requerido',
         'email.email'=>'El formato valido para el campo correo electronico es example@example.com'
      ];

      $this->validate($request,[
         'email'=>'required|email'
      ]);

      $us=User::where('email',$request->email)->where('status','ACTIVE')
      ->where('confirmed',1)->count();


      if($us == 0){
         return redirect()->route('password.request')->with('error','El email ingresado no se encuentra registrado en widelip. Intenta nuevamente');
      }else{
         $user=User::where('email',$request->email)->first();
         $random_password = str_random(20);
          Mail::to($request->email)->send(new RecuperatePass($user,$random_password));
      }
   }

   public function reset_data($pass){
      $token=$pass;
      return view('auth.passwords.reset',compact('token'));
   }

   public function password_confirm_data(Request $request){
      $messages=[
         'email.required'=>'EL campo correo electronico es requerido',
         'email.email'=>'El campo email',
         'password.required'=>'El campo contraseña es requerido',
         'password.string'=>'El campo contraseña solo acepta numeros y letras',
         'password.confirmed'=>'Las contraseñas no coinciden',
      ];
      $this->validate($request,[
         'email'=>'required|email',
         'password'=>'required|string|confirmed'
      ],$messages);

       $us=User::where('email',$request->email)->where('status','ACTIVE')
      ->where('confirmed',1)->count();

      if($us == 0){
         $tokem=$request->token;
         return redirect()->route('reset_data',$request->token)->with('error','El email ingresado no se encuentra registrado en widelip, intente de nuevo');
      }else{
            $user=User::where('email',$request->email)->first();
            $user->password=$request->password;
            $user->save();

            return redirect()->route('login')->with('success','Contraseña recuperada con exito, inicie sesión para seguir desfrutando de widelip');
      }
   }
}
