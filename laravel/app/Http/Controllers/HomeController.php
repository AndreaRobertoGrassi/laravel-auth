<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
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
    
    public function updateUser(Request $request){
        $request -> validate([
            'icon'=> 'required|file'
        ]);

        $this-> deleteIcon();

        $img=$request->file('icon');
        $ext=$img-> getClientOriginalExtension();   //estensione
        $name=rand(100000,999999).'_'.time();       //genera numero casuale
        $destFile=$name.'_'.$ext;     
        $file=$img->storeAs('icon',$destFile,'public');     //salvo il file in storage con il nome generato casualmente
        $user= Auth::user();     //recuper l'utente loggato
        $user-> icon=$destFile;
        $user -> save();
        return redirect()->back();

    }

    public function clearuserIcon(){
        
        $this-> deleteIcon();  

        $user= Auth::user();
        $user-> icon=null;
        $user -> save();
        return redirect()->back();
    }

    private function deleteIcon(){
        $user= Auth::user();
        try {
            $fileName=$user -> icon;
            $file=storage_path('app/public/icon/'. $fileName);
            File::delete($file);
        }catch(\Exception $e){ }
        
    }
}
