@extends('admin/index',[
        'title' => "Аккаунт",
        "prefix_body" => 'acount',
    ])
@section('content')
    <h1 class="text-center">Логи</h1>
    <div class="row text-center title_log_block">
        <div class="col">
            Старая запись
        </div>
        <div class="col">
            Новая запись
        </div>
    </div>
    @foreach ($logs as $log)
        <div class="log_block">
            <div class="card text-center ">
                <div class="card-header">
                    <span class="users">Пользователь №{{ $log->users_id }}</span>
                    <span class="action">{{ $log->description }}</span>
                </div>
                <div class="card-body">
                    <div class="row flex-nowrap">
                        <div class="col text-wrap">
                            {{ $log->old_value }}
                        </div>
                        <div class="col text-wrap">
                            {{ $log->new_value }}
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    {{ $log->timestamp }}
                </div>
            </div>
        </div>
    @endforeach
    {{ $logs->links() }}
@endsection
