<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .container{
                margin: auto 300px;
            }
            </style>
    </head>
    <body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Articles <small>({{ $articles->count() }})</small>
            </div>
            <div class="card-body">
                <form action="{{ url('/') }}" method="get">
                    <div class="form-group">
                        <input
                            type="text"
                            name="query"
                            class="form-control"
                            placeholder="Search..."
                            value="{{ request('query') }}"
                        />
                    </div>
                </form>
                @forelse ($articles as $article)
                    <article class="mb-3">
                        <h2>{{ $article->title }}</h2>
                        <p class="m-0">{{ $article->body }}</body>
                        <div>
                            @foreach ($article->tags as $tag)
                                <span class="badge badge-light">{{ $tag}}</span>
                            @endforeach
                        </div>
                    </article>
                @empty
                    <p>No articles found</p>
                @endforelse
            </div>
        </div>
    </div>
    </body>
</html>
