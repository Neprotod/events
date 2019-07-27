@extends('index',[
        'title' => "Главная страница",
        "prefix_body" => 'home',
    ])
@section('content')
    <h1>Комментатор</h1>
    @auth
        <form method="post" action="/" class="form_answer">
            <div class="form-group">
                <label for="add_comment">Добавить комментарий</label>
                <textarea name="massage" class="form-control" id="add_comment" rows="3">{{ old("massage") }}</textarea>
                <button type="submit" class="btn btn-success send">Отправить</button>
            </div>
        </form>
    @endauth
    <form method="post" action="/" class="form_answer">
        @include('content/comments')
    </form>
    <script>
        // Обрабатывает нажатие отправить.
        handel.answer_send();
    </script>
@endsection
