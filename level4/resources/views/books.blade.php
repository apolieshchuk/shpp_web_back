@extends('main')

@section('content')
<section id="main" class="main-wrapper">
    <div class="container">
        <div id="content" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
            @foreach($books as $book)
                <div data-book-id="{{ $book->id }}"
                     class="book_item col-xs-6 col-sm-3 col-md-2 col-lg-2">
                    <div class="book">
                        <a href="/books/{{ $book->id }}"><img src="/assets/books-preview/{{ $book->preview }}" alt="{{ $book->book }}">
                            <div data-title="{{ $book->book }}" class="blockI" style="height: 46px;">
                                <div data-book-title="{{ $book->book }}" class="title size_text">{{ $book->book }}</div>
                                <div data-book-author="{{ $book->authors }}" class="author">{{ $book->authors }}</div>
                            </div>
                        </a>
                        <a href="/books/{{ $book->id }}">
                            <button type="button" class="details btn btn-success">Читать</button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div style="display: flex; align-self: center; justify-content: center">
        <button style="display: {{ (count($books) > $minOffset) ? 'block' : 'none' }};
            margin-right: 20px; height: 38px; width: 80px;"
                onclick="location.href = '/?offset={{ max(count($books) - $step, $minOffset) }}'"
                type="button" class="details btn btn-success">Назад</button>
        <button
            style="display: {{ (count($books) < \App\Books::count()) ? 'block' : 'none' }};
                margin-bottom: 20px; height: 38px; width: 80px;"
            onclick="location.href = '/?offset={{ count($books) + $step }}'"
            type="button" class="details btn btn-success">Вперед</button>
    </div>
</section>
@endsection
