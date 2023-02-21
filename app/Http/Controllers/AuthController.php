<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\models\User;

class AuthController extends Controller
{
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

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("login");
    }

    public function register(Request $request){
        if(count(User::where("email", $request->email)->get()) == 0){

            if($request->password == $request->password2){
                User::create(["name" => $request->name, "email" => $request->email, "password" => bcrypt($request->password)]);
                $credentials = $request->only("email", "password");
                if(Auth::attempt($credentials)){
                    request()->session()->regenerate();
                    return redirect("dashboard");
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
            return redirect("register")->with("email", "Email ya registrado");
        }
    }
}
