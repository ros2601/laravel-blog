<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\{User,upload,comment,contact};
use Illuminate\Support\Facades\Auth;
 
class AuthController extends Controller
{
    //------------------------------------To display blogs on home page--------------------------------------------
    public function blogs()
    {
        $product=upload::orderBy('id','desc')->get();
        return view('home',compact('product'));
    }
    //---------------------------To upload a particular post by a auth user----------------------------------------
    public function upload(Request $request)
    {
        if(Auth::check())
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
        else{
        return back();
        }
    }
    //-----------------------for displaying a blog with particular comments on it with users----------------------
    public function detail($id)
    {
        $findrec=upload::where('id',$id)->get();
        $cmnts = comment::where('post_id','user_id', $id)->with('upload','user')->orderBy('id','desc')->get();
        // dd($cmnts);
        return view('detail',compact('findrec','cmnts'));
    }
    // -----------To add a new comment in comment table by a authenticated user on a particular post----------
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
    // -----------------Sends query/feedback/compliants through contact form----------------------------------
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
        return back()->with('message', 'Message Send Successfully !');
    }
     //----------------Shows particular posts that is posted by loged in user----------------------------------
     public function user()
     {
        if(Auth::check())
        {
            $user = upload::select('*')
            ->where('postedby', Auth::user()->name)
            ->get();
            return view('home',compact('user'));
        }
     }
    //-------------------To delete a particular post posted by the user-----------------------------------------
    public function delete($id)
    {  
        $obj= upload::find($id);    
        unlink('storage/images/'.$obj->image);
        $obj->delete();
        return back();
    }
}
