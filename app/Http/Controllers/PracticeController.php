<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\User;
class PracticeController extends Controller
{    
     

   public function __construct(){
       $this->middleware('auth');
   }

    public function index(){
        return view("welcome");
    }

    public function getData(){
        $user= User::find(auth()->user()->id);
        return response()->json($user->blogs);  
    }

    public function edit($id){
        $Blog = Blog::find($id);
        return response()->json($Blog);
    }

    public function update(Request $request){
        $id = $request->id ;
        $Blog = Blog::find($id);
        $Blog->content = $request->content ;
        $Blog->title = $request->title ;
        $Blog->save();
        return response()->json(['success'=>'Data is successfully updated']);
    }

    public function store(){
     
        $data = request()-> validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $data['user_id'] = auth()->user()->id;

        Blog::create($data);
        return response()->json(['success'=>'Data is successfully Added']);
    }

    public function destroy($id){
        Blog::find($id)->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }

}
