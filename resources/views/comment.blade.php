@extends('blogComment')

@section('comment')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>Ini COMMENT</h1>
                    {{-- @foreach ($dataBlog as $blog)
                    <div class="card mb-2">
                        <h1>{{$blog->title}}</h1>
                        <h6>{{$blog->name}}</h6>
                        <p>{{$blog->description}}</p>
                        <main class="py-4">
                            @yield('comment')
                        </main>
                    </div>
                    @endforeach --}}
                    <h1>Oke</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection