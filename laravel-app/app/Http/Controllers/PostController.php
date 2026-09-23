<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Homepage: overzicht van alle blogposts.
     */
    public function index()
    {
        $posts = Post::latest()->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Detailpagina van één blogpost. Laravel zoekt de post automatisch op
     * via de slug in de url (route model binding, zie routes/web.php).
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
