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
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        @media(min-width: 960px) {
            .container {
                margin: auto 300px;
            }

            article {
                display: flex;
                flex-direction: row-reverse;
                margin: auto 32px;
                align-items: center;
                justify-content: flex-end;
            }

            article img {
                flex-basis: 300px;
                min-width: 300px;
                min-height: 200px;
            }

            .article-content {
                margin-left: 3rem;
            }
        }

        @media(max-width: 960px) {
            .container {
                margin: auto 2rem;
            }

            article {
                display: flex;
                flex-direction: column-reverse;
                margin: 3rem auto;
                border: solid 1px gray;
                border-radius: 10px;
                padding: 5px;
            }

            article img {
                flex-basis: 300px;
                min-width: 300px;
                min-height: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Discounts <small>({{ $discounts->count() }})</small>
            </div>
            <div class="card-body">
                <form action="{{ url('/discounts') }}" method="get">
                    <div class="form-group">
                        <input type="text" name="query" class="form-control" placeholder="Search..." value="{{ request('query') }}" />
                    </div>
                </form>
                @forelse ($discounts as $discount)
                <article class="mb-3">
                    <div class="article-content">
                        <h1>{{ $discount->title }}</h1>
                        <p>Категория</p><strong>{{$discount->category->title}}</strong>
                        <p class="m-0">{{ Str::limit($discount->description, 100, '...') }}
                        </p>
                        <div>
                            @foreach ($discount->tags as $tag)
                            <span class="badge badge-light">
                                <a href="/discounts?query={{$tag}}">{{ $tag}}</a></span>
                            @endforeach
                        </div>
                    </div>
                    <img src="{{$discount->image_url}}" />

                </article>
</body>

@empty
<p>No articles found</p>
@endforelse
</div>
</div>
</div>
</body>

</html>