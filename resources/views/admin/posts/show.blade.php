@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <h1 class="mt-3 mb-3">Dettagli post</h1>
                </div>
                <div>
                    @if($post->cover_image)
                        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="">
                    @endif
                </div>
                <p>
                    <strong>Titolo:</strong>
                    {{ $post->title }}
                </p>
                <p>
                    <strong>Contenuto:</strong>
                    {{ $post->content }}
                </p>
                <p>
                    <strong>Slug: </strong>
                    {{ $post->slug }}
                </p>
                <p>
                    <strong>Categoria: </strong>
                    {{ $post->category->name ?? '-' }}
                </p>
                <p>
                    <strong>Creato il: </strong>
                    {{ $post->created_at }}
                </p>
                <p>
                    <strong>Ultima modifica: </strong>
                    {{ $post->updated_at }}
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
