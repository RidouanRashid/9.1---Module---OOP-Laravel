@extends('layouts.app')

@section('title', 'Laravel From Scratch Blog')

@section('content')
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Latest <span class="text-blue-500">Laravel From Scratch</span> News
        </h1>

        <h2 class="inline-flex mt-2">By Lary Laracore <img src="{{ asset('images/lary-head.svg') }}" alt="Head of Lary the mascot"></h2>

        <p class="text-sm mt-14">
            Another year. Another update. We're refreshing the popular Laravel series with new content.
            I'm going to keep you guys up to speed with what's going on!
        </p>
    </header>

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($posts as $post)
            <article class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
                <div class="py-6 px-5">
                    <img src="{{ asset('images/' . $post->image) }}" alt="Blog Post illustration" class="rounded-xl">

                    <div class="mt-8 flex flex-col justify-between">
                        <header>
                            <div class="space-x-2">
                                @foreach ($post->tagList() as $tag)
                                    <span class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold" style="font-size: 10px">{{ $tag }}</span>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <h1 class="text-2xl">{{ $post->title }}</h1>

                                <span class="mt-2 block text-gray-400 text-xs">
                                    Published <time>{{ $post->created_at->diffForHumans() }}</time>
                                </span>
                            </div>
                        </header>

                        <div class="text-sm mt-4">
                            <p>{{ $post->excerpt }}</p>
                        </div>

                        <footer class="flex justify-between items-center mt-8">
                            <div class="flex items-center text-sm">
                                <img src="{{ asset('images/lary-avatar.svg') }}" alt="Lary avatar" width="32">
                                <div class="ml-3">
                                    <h5 class="font-bold">Lary Laracore</h5>
                                    <h6>Mascot at Laracasts</h6>
                                </div>
                            </div>

                            <div>
                                <a href="{{ route('post.show', $post) }}"
                                   class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8">
                                    Read More
                                </a>
                            </div>
                        </footer>
                    </div>
                </div>
            </article>
        @endforeach
    </main>
@endsection
