<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $data = [
            'categories' => $categories,
            'tags' => $tags
        ];
        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validazione dati
        $request->validate([
            'title' => 'required|max:255|unique:posts,title',
            'content' => 'required',
            'image' => 'image|max:1024'
        ]);

        $dati = $request->all();

        $dati['slug'] = generaSlug($dati);//slug finale

        // verifico se l'utente ha caricato una foto
        if($dati['image']) {
            // carico l'immagine
            $img_path = Storage::put('uploads', $dati['image']);
            $dati['cover_image'] = $img_path;
        }

        // salvo i dati del post
        $nuovo_post = new Post();
        $nuovo_post->fill($dati);
        $nuovo_post->save();

        // se l'utente ha selezionato dei tag li associo al post così non da più errore se non seleziona niente
        if(!empty($dati['tags'])) {
            $nuovo_post->tags()->sync($dati['tags']);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if($post) {
            $categories = Category::all();
            $tags = Tag::all();
            $data = [
                'post' => $post,
                'categories' => $categories,
                'tags' => $tags
            ];
            return view('admin.posts.edit', $data);
        } else {
            return abort('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255|unique:posts,title,'.$id,
            'content' => 'required'
        ]);

        $dati = $request->all();

        $dati['slug'] = generaSlug($dati);

        // verifico se l'utente ha caricato una foto
        if($dati['image']) {
            // carico l'immagine
            $img_path = Storage::put('uploads', $dati['image']);
            $dati['cover_image'] = $img_path;
        }

        $post = Post::find($id);
        $post->update($dati);

        // se l'utente ha selezionato dei tag li associo al post
        if(!empty($dati['tags'])) {
            $post->tags()->sync($dati['tags']);
        } else {
            // l'utente non ha selezionato nessun tag => faccio detach dei tag
            // $post->tags()->detach();
            $post->tags()->sync([]);
        }


        return redirect()->route('admin.posts.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post) {
            $post->delete();
            return redirect()->route('admin.posts.index');
        } else {
            return abort('404');
        }
    }
}

function generaSlug($dati)
{
    $slug = Str::of($dati['title'])->slug('-');
    $slug_iniziale = $slug;
        //verifico che lo slug sia unico
        $post_trovato = Post::where('slug', $slug)->first();
        $contatore = 0;
        while($post_trovato) {
            $contatore++;
            //genero il nuovo slug concatenando il contatore
            $slug = $slug_iniziale . '-' . $contatore;
            $post_trovato = Post::where('slug', $slug)->first();
        }
        //adesso sono sicura che lo slug sia unico
        return $slug;
}
