<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\{User,upload,comment,contact};
use Illuminate\Support\Facades\Auth;
 
class CustomAuthController extends Controller
{
    public function home()
    {
        return view('homepage');
    } 
 
    public function index()
    {
        return view('login');
    }  
       
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
 
    public function signup()
    {
        return view('registration');
    }
       
    public function signupsave(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
            
        $data = $request->all();
        $check = $this->create($data);
          
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
           return redirect('home');
        }
    }
 
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
     
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
        return redirect('/home');
    }
     
    public function signOut() {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
    public function products()
    {
        $product=upload::orderBy('id','desc')->get();
        return view('home',compact('product'));
    }
    public function upload(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ]);
        $add= new upload;

        $add->title=$request->get('title');
        $add->content=$request->get('content');
        $add->postedon=$request->get('postedon');
        $add->postedby=$request->get('postedby');
        $file = $request->file('image');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $path= $file->storeAs('public/images', $fileName);
        $add->image=$fileName;
        $add->save();
        return redirect('home');
    }
    //for displaying a blog
    public function detail($id)
    {
        $findrec=upload::where('id',$id)->get();
        $cmnts = comment::where('post_id', $id)->with('upload')->orderBy('id','desc')->get();;
        // $user = comment::where('user_id', $id)->with('user')->get();
        return view('detail',compact('findrec','cmnts'));
    }
    // --------------------------------------------------------------------
    public function comments(Request $request)
    {
        $add = new comment();
        if ($request->isMethod('post'))
        {
            $add->comment = $request->get('comment');
            $add->post_id = $request->get('post_id');
            $add->user_id = $request->get('user_id');
            $add->user = $request->get('user');
            $add->save();
        }
        return back();
    }
    // -------------------contact-------------------------------
    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);
        $add= new contact;

        $add->name=$request->get('name');
        $add->email=$request->get('email');
        $add->message=$request->get('message');
        $add->save();
        return back()->withErrors(["custom_name" => "Message send Successfully !"]);
    }
     // -------------------contact-------------------------------
     public function user()
     {
        if(Auth::user())
        {
            // echo Auth::user()->name;
            $user = upload::select('*')
            ->where('postedby', Auth::user()->name)
            ->get();
            // echo "<pre>";
            // echo $user;
            return view('home',compact('user'));
        }
     }
    public function delete($id)
    {  
        $obj= upload::find($id);    
        unlink('storage/images/'.$obj->image);
        $obj->delete();
        return back();
    }
}
