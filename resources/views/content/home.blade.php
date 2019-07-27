@extends('index',[
        'title' => "Главная страница",
        "prefix_body" => 'home',
    ])
@section('content')
    <h1>Комментатор</h1>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @auth
        <form method="post" action="{{ route("comment") }}" class="form_answer">
            @csrf
            <div class="form-group">
                <label for="add_comment">Добавить комментарий</label>
                <textarea name="message" class="form-control" id="add_comment" rows="3">{{ old("message") }}</textarea>
                <button type="submit" name="add" value="1" class="btn btn-success send">Отправить</button>
            </div>
        </form>
    @endauth
    <form method="post" action="{{ route("comment") }}" class="form_answer">
        @csrf
        @include('content/comments')
    </form>
    <script>
        handel.answer_send();
    </script>
@endsection
