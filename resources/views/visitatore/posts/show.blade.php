@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ $post->title }}</h1>
            <div>
                @if($post->cover_image)
                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}">
                @endif
            </div>
            <p>{{ $post->content}}</p>
            <p>Categoria:
                @if ($post->category)
                    <a href="{{ route('posts.category', ['slug' => $post->category->slug]) }}">
                        {{ $post->category->name ?? '-'}}
                    </a>
                @else
                    -
                @endif
            </p>
            <p>Tags:
                @forelse ($post->tags as $tag)
                    {{ $tag->name }}{{ $loop->last ? '' : ', '}}
                @empty
                    -
                @endforelse
            </p>
        </div>
    </div>
</div>
@endsection
