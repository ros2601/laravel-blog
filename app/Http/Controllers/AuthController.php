<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\{User};
use Illuminate\Support\Facades\Auth;
 
class AuthController extends Controller
{
    public function index(){
        return view('login');
    }
     public function signup(){
        return view('registration');
    }
    //--------------------------------for signup form-------------------------------------------------------- 
    public function signupsave(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
            
        $data = $request->all();
        $this->create($data);
          
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
           return redirect('home');
        }
    }
    //-----------------------------------------------------------------------------------------------------------------
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    //------------------------------------------------for login-----------------------------------------------------------
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
           return redirect('home');
        }
   
        return redirect('/login')->with('message', 'Login details are not valid!');
    }    
    //-------------------------------for logout---------------------------------------------------------
    public function signOut() 
    {
        Auth::logout();
        return redirect('login');
    }
    
 }
