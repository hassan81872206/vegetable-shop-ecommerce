<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{
    public function loginPage(){
        return view("login");
    }

    public function login(Request $request){
        $fields = $request->validate([
            "email" => ["required" , "email" ],
            "password" => ["required", "min:8", "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"],
        ]);
        if(Auth::attempt(["email" => $fields["email"] , "password" => $fields["password"]] , $request->has("remember"))){
            if(Auth::user()->role == "customer"){
                return redirect("/");    
            }else if(Auth::user()->role == "admin"){
                return to_route("adminDashboard");
            }
        }else{
            return to_route("login")->with("inc" , "Incorrect email or password");
        }
    }

    public function register(Request $request){
        $fields = $request->validate([
            "name" => ["required" , 'max:30' , 'min:5' , "regex:/^[\p{L}\s]+$/u" ],
            "email" => ["required" , "email" , "unique:users,email"],
            "password" => ["required", "min:8", "confirmed", "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"],
            "phone" => ["required" , "digits:8" , 'unique:users,phone']
        ]);
        $customer = User::create($fields);
        event(new Registered($customer));
        if($request["remember"]){
            Auth::login($customer , true);
        }else{
            Auth::login($customer);
        }
        return to_route("verification.notice");
        return redirect("/");

    }

    public function logout(){
        $user = Auth::user();
        Auth::logout($user);
        return redirect('/');
    }

    public function noticeVerify () {
        return view('auth.verify-email');
    }

    public function emailVerify(EmailVerificationRequest $request) {
        $request->fulfill();
     
        return redirect('/');
    }

    public function resendEmail(Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('message', 'Verification link sent!');
    }

    public function profile(){
        $customer = Auth::user();
        return view("auth.profile" , ["customer" , $customer]);
    }
}
