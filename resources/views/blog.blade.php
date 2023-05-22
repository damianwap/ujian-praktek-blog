@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-2" style="text-align: right;">
        @auth
        <a class="btn btn-primary" href="{{url('blog/create')}}"><i class="bi bi-plus-lg"></i> Add new</a>

                    @endauth
        {{-- <a class="btn btn-primary" href="{{url('blog/create')}}"><i class="bi bi-plus-lg"></i> Add new</a> --}}
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                <div class="card-body" >
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($dataBlog as $blog)
                    <div class="card mb-2 blog-detail" onclick="this.querySelector('a').click(); return true;">
                        <div class="row" style="margin: 20px;">
                            <div class="col-md-10"><h1><a href="{{url('blog/'.$blog->id)}}" class="text-reset text-decoration-none">{{$blog->title}}</a></h1></div>
                            {{-- <h6>Tanggal: {{$blog->created_at->format('d/m/Y')}}</h6> --}}
                            {{ \Carbon\Carbon::parse($blog->created_at)->isoFormat('dddd D MMM Y')}}
                            <h6>Penulis: {{$blog->name}}</h6>
                            <p>{{$blog->description}}</p>
                            @yield('comment')
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{$dataBlog->links()}}
    </div>
</div>
@endsection
