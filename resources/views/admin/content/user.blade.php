@extends('admin/index',[
        'title' => "Пользоваватель",
        "prefix_body" => 'acount',
    ])
@section('content')
    <h1 class="text-center">Пользователь</h1>
    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">

                        <div class="card-body">
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route("admin.user_update",$user->id) }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}" />
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('ФИО') }}</label>

                                    <div class="col-md-6">
                                        <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name',$user->full_name) }}" required autocomplete="full_name" autofocus>

                                        @error('full_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mob_phone" class="col-md-4 col-form-label text-md-right">{{ __('Мобильный') }}</label>

                                    <div class="col-md-6">
                                        <input id="mob_phone" type="text" class="form-control @error('mob_phone') is-invalid @enderror" name="mob_phone" value="{{ old('mob_phone',$user->mob_phone) }}" required autocomplete="mob_phone" autofocus>

                                        @error('mob_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="hobby" class="col-md-4 col-form-label text-md-right">{{ __('Хобби') }}</label>

                                    <div class="col-md-6">
                                        <input id="hobby" type="text" class="form-control @error('hobby') is-invalid @enderror" name="hobby" value="{{ old('hobby', $user->hobby) }}" required autocomplete="hobby" autofocus>

                                        @error('hobby')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('День рождения') }}</label>

                                    <div class="col-md-6">
                                        <input id="birthday" class="birthday" type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday', $user->birthday) }}" required autocomplete="birthday"  autofocus>


                                        @error('birthday')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Адрес') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Подтверждение пароля') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Изменить') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
