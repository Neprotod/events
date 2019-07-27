@extends('admin/index',[
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
    <form method="post" action="{{ route("admin.comment") }}" class="form_answer">
        @csrf
        @include('admin/content/comments')
    </form>
    <script>
        handel.answer_send();
    </script>
@endsection
