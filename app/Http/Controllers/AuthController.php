<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;

class AuthController extends Controller
{
    /* Iniciar Sesion */
    public function login(Request $request){
        $credentials = $request->only("email", "password");
        $remember = $request->remember?true:false;

        if(Auth::attempt($credentials, $remember)){
            request()->session()->regenerate();
            return redirect("inicio");
        }
        else{
            return redirect("login")->with("invalido", "Las credenciales no son correctas");
        }
    }

    /* Cerrar Sesion */
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("login");
    }

    /* Registrarse */
    public function register(Request $request){
        $email = User::where("email", $request->email)->get();
        $name = User::where("name", $request->name)->get();
        if(count($email) == 0){
            if(count($name) == 0){
                if($request->password == $request->password2){
                    $user = User::create(["name" => $request->name, "email" => $request->email, "password" => bcrypt($request->password)]);

                    $user_profile = new Profile();
                    $user_profile->fullname = $user->name;
                    $user_profile->img = "img/default_profile/default_avatar.png";
                    $user_profile->user_id = $user->id;
                    $user_profile->save();

                    $credentials = $request->only("email", "password");
                    if(Auth::attempt($credentials)){
                        request()->session()->regenerate();
                        return redirect("inicio");
                    }
                    else{
                        return redirect("login");
                    }
                }
                else{
                    return redirect("register")->with("password", "Las contraseñas no coinciden");
                }
            }
            else{
                return redirect("register")->with("username", "El nombre de usuario ya esta registrado");
            }
        }
        else{
            return redirect("register")->with("email", "Email ya registrado");
        }
    }
}
