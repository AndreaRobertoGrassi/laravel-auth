<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function sendMail(Request $request){
        $data=$request -> validate([
            'text'=>'required|min:5'
        ]); 
        Mail::to(Auth::user()-> email)-> send(new TestMail($data['text']));
        return redirect()-> back();
    } 

    public function sendEmptyMail(){
        Mail::to(Auth::user()-> email)-> send(new TestMail());
        return redirect()-> back();
    }
}
