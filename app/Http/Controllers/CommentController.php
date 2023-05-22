<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table("comments")
        ->join("blogs", function($join){
            $join->on("comments.blog_id", "=", "blogs.id");
        })
        ->join("users", function($join){
            $join->on("comments.user_id", "=", "users.id");
        })
        ->select("comments.message", "users.name")
        ->get();
        // dd($data);
        return view('comment', ['dataComment' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'message' => 'required'
        ]);

        if($validator -> fails()){
            return redirect('blog/'.$request->blog_id)->withErrors($validator);
        }else{
            $data = new Comment;
            $data->message = $request->message;
            $data->blog_id = $request->blog_id;
            $data->user_id = Auth::user()->id;
            $data->save();
            return redirect('blog/' .$request->blog_id);
        }
        // dd($data);
        // if($data->save()){
        //     return redirect()->back();
        // }else{
        //     return redirect('blog');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
        $data = Comment::find($request->id);
        $data->message = $request->message;
        // $data->description = $request->description;
        // dd($data);
        if($data->save()){
            return redirect()->back();
        }else{
            return redirect('blog');
            // return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment, $id)
    {
        //
        $data = Comment::destroy($id);
        return redirect()->back();
    }
}
