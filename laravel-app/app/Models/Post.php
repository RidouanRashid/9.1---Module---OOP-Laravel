<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'tags',
        'excerpt',
        'body',
    ];

    /**
     * Laravel gebruikt de slug in plaats van het id bij route model binding
     * (Route::get('/post/{post:slug}', ...)).
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Zet de opgeslagen "Techniques,Updates" string om naar een array,
     * zodat de badges makkelijk te loopen zijn in de view.
     */
    public function tagList(): array
    {
        return array_filter(explode(',', (string) $this->tags));
    }

    /**
     * Zet de body (paragrafen gescheiden door een lege regel) om naar
     * een array van paragrafen voor de detailpagina.
     */
    public function paragraphs(): array
    {
        return preg_split('/\n{2,}/', trim($this->body));
    }
}
