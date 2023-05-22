@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>Add New Post</h1>
                    <form class="row g-3" action="{{url('blog/add')}}" method="post">
                        @csrf
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="postTitle" class="col-form-label">Title</label>
                                    <input id="postTitle" type="text" class="form-control" name="title" value="">
                                </div>
                                @error('title')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="postDescription" class="col-form-label">Description</label>
                                    <textarea id="postDescription" name="description" class="input-description form-control" aria-label="With textarea"></textarea>
                                </div>
                                @error('description')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                        </div>
                        <div style="margin-top: 20px;">
                            <button class="btn btn-primary" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
