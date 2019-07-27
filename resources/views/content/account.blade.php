@extends('index',[
        'title' => "Аккаунт",
        "prefix_body" => 'acount',
    ])
@section('content')
    <h1 class="text-center">Аккаунт</h1>
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
                            <form method="POST" action="{{ route('account') }}">
                                @csrf
                                <input type="hidden" name="log_action" value="update"  />
                                <input type="hidden" name="id" value="{{ $user->id }}"  />
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('ФИО') }}</label>
                                    <div class="col-md-6 form_string">
                                        {{ $user->full_name }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Мобильный') }}</label>
                                    <div class="col-md-6 form_string">
                                        {{ $user->mob_phone }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="hobby" class="col-md-4 col-form-label text-md-right">{{ __('Хобби') }}</label>

                                    <div class="col-md-6">
                                        <input id="hobby" type="text" class="form-control @error('hobby') is-invalid @enderror" name="hobby" value="{{ old('hobby',$user->hobby) }}" required autocomplete="hobby" autofocus>

                                        @error('hobby')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('День рождения') }}</label>

                                    <div class="col-md-6 birthday form_string">
                                        {{ $user->birthday }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Адрес') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email) }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Сменить пароль') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

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
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
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
