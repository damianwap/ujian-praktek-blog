<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table("blogs")
        ->join("users", function($join){
            $join->on("users.id", "=", "blogs.user_id");
        })
        ->select("blogs.id", "blogs.title", "blogs.description", "users.name", "blogs.created_at", "blogs.updated_at")->simplePaginate(5);
        // dd($data);
        return view('blog', ['dataBlog' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::check()) {
            return view('blogCreate');
        }else{
            return redirect('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = VALIDATOR::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator -> fails()) {
            return redirect('blog/create')->withErrors($validator)->withInput($request->input());
        }else{
            $data = new Blog;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->user_id = Auth::user()->id;
            $data->save();
            return redirect('blog');
        }

        // if($data->save()){
        //     return redirect('blog');
        // }else{
        //     return redirect()->back()->withInput();
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showComment(Blog $blog, $id){
        $data = Blog::find($id);
        

        $dataComment = DB::table("comments")
        ->join("blogs", function($join){
            $join->on("comments.blog_id", "=", "blogs.id");
        })
        ->join("users", function($join){
            $join->on("comments.user_id", "=", "users.id");
        })
        ->select("comments.message", "comments.id", "comments.user_id", "comments.blog_id", "users.name")->where("comments.blog_id", "=", $id)
        ->get();
        // dd($dataComment);
        // dd($data);
        return view('blogComment', ['dataBlog' => $data, 'dataComment' => $dataComment]);
    }

    public function show(Blog $blog, $id)
    {
        //
        // $data = DB::table("blogs")
        // ->join("users", function($join){
        //     $join->on("users.id", "=", "blogs.user_id");
        // })
        // ->select("blogs.id", "blogs.title", "blogs.description", "users.name")
        // ->where("blogs.id", "=", $id)
        // ->get();
        $data = Blog::find($id);
        // dd($data);
        
        return view('blogUpdate', ['dataBlog' => $data]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
        $validator = VALIDATOR::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ]);
        
        if ($validator -> fails()) {
            return redirect('blog/edit/'.$request->id)->withErrors($validator)->withInput();
        }else{
            $data = Blog::find($request->id);
            $data->title = $request->title;
            $data->description = $request->description;
            $data->save();
            return redirect('blog/'.$request->id);
        }
        // if($data->save()){
        //     return redirect('/blog');
        // }else{
        //     return redirect()->back()->withInput();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog, $id)
    {
        //
        $data = Blog::destroy($id);
        return redirect('/blog');
    }
}
