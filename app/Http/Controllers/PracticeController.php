<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
class PracticeController extends Controller
{    

    public function index(){
        return view("welcome");
    }

    public function getData(){
        $post =Blog::all();
        return response()->json($post);  
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

    public function store(Request $request){
        $Blog= new Blog();
        $Blog->content = $request->content ;
        $Blog->title = $request->title ;
        $Blog->save();
        return response()->json(['success'=>'Data is successfully added']);
    }

    public function destroy($id){
        Blog::find($id)->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }

}
