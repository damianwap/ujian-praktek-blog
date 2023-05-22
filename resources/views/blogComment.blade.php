@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-10">
                            <h1>{{$dataBlog->title}}</h1>
                        </div>
                        @auth
                        @if (Auth::user()->id == $dataBlog->user_id)
                            
                        <div class="col-md-2" style="text-align: right">
                            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="bi bi-three-dots"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{url('blog/edit/'.$dataBlog->id)}}">Edit</a>
                                </li>
                                <li>
                                    <form action="{{url('blog/delete/'.$dataBlog->id)}}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @endif
                        @endauth
                        <input type="text" name="id" hidden value="{{$dataBlog->id}}">
                        <p>{{$dataBlog->description}}</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @foreach ($dataComment as $comment)
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="fw-bold col-md-10">
                                {{$comment->name}}
                            </div>
                            @auth
                                @if (Auth::user()->id == $comment->user_id)
                                    
                                <div class="col-md-2" style="text-align: right">
                                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <p class="dropdown-item" id="editLink_{{$comment->id}}" onclick="editComment({{$comment->id}})">Edit</p>
                                    </li>
                                    <li>
                                        <form action="{{url('comment/delete/'.$comment->id)}}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="dropdown-item text-danger">Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            @endif
                            @endauth
                        </div>
                    </div>
                    <div class="card-body">
                        <p id="{{$comment->id}}">{{$comment->message}}</p>
                    </div>
                </div>                  
                @endforeach
            </div>
            @auth
            <div class="mb-3">
                <h3>Leave a comment</h3>
                <form action="{{url('comment/add')}}" method="post">
                    @csrf
                    <input type="text" name="blog_id" hidden value="{{$dataBlog->id}}">
                    <textarea id="postDescription" name="message" class="input-message form-control" aria-label="With textarea"></textarea>
                    @error('message')
                        <span class="text-danger">{{$message}}
                        </span>
                    @enderror
                    <div>
                        <button type="submit" class="btn btn-primary  mt-3">Submit</button>
                    </div>
                </form>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection
