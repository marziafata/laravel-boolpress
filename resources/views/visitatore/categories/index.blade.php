@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Elenco categorie</h1>
            <ul>
                @foreach ($categories as $category)
                <li>
                    <a href="{{ route('posts.category', ['slug' => $category->slug]) }}">
                        {{ $category->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <a href="{{ route('posts') }}">
            Vai ai post
        </a>
    </div>
</div>
@endsection
