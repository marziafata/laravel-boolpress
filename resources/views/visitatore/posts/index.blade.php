@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Elenco Post</h1>
            <ul>
                @foreach ($posts as $post)
                <li>
                    <a href="{{ route('posts.show', ['slug' => $post->slug]) }}">
                        {{ $post->title }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
