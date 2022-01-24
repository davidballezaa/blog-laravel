@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($posts as $post)
                <div class="card border border-2 mb-3">
                    @if ($post->image)
                        <img src="{{$post->get_image}}" class="card-img-top img-fluid" style="aspect-ratio: 16 / 9;">
                    @elseif ($post->iframe)
                        <div class="embed-responsive embed-responsive-16by9">
                            {!!$post->iframe!!} 
                        </div>
                    @endif

                    <div class="card-body">
                        <h4 class="card-title">{{ $post->title }}</h4>
                    
                        <p class="card-text">
                            {{ $post->get_excerpt }}...
                            <a href="{{ route('post', $post) }}">Leer mas</a>
                        </p>
                        <p class="text-muted mb-0">
                            <em>
                                &ndash; {{$post->user->name}}
                            </em>

                            {{$post->created_at->format('d M Y')}}
                        </p>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center">
                {{$posts->links()}}
            </div>
        </div>
    </div>
</div>
@endsection