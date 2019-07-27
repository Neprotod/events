@extends('admin/index',[
        'title' => "Пользователи",
        "prefix_body" => 'acount',
    ])
@section('content')
    <h1 class="text-center">Пользователи</h1>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ФИО</th>
                <th scope="col">email</th>
                <th scope="col">Телефон</th>
                <th scope="col" colspan="2">День рождения</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td><a href="{{ route("admin.user", $user->id) }}">{{ $user->full_name }}</a></td>
                    <td><a href="{{ route("admin.user", $user->id) }}">{{ $user->email }}</a></td>
                    <td><a href="{{ route("admin.user", $user->id) }}">{{ $user->mob_phone }}</a></td>
                    <td><a href="{{ route("admin.user", $user->id) }}">{{ $user->birthday }}</a></td>
                    <td><a href="{{ route("admin.user_drop", $user->id) }}">Удалить</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection
