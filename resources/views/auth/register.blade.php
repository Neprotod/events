@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('ФИО') }}</label>

                            <div class="col-md-6">
                                <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" required autocomplete="full_name" autofocus>

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
                                <input id="mob_phone" type="text" class="form-control @error('mob_phone') is-invalid @enderror" name="mob_phone" value="{{ old('mob_phone') }}" required autocomplete="mob_phone" autofocus>

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
                                <input id="hobby" type="text" class="form-control @error('hobby') is-invalid @enderror" name="hobby" value="{{ old('hobby') }}" required autocomplete="hobby" autofocus>

                                @error('hobby')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthday_dd" class="col-md-4 col-form-label text-md-right">{{ __('День рождения') }}</label>

                            <div class="col-md-6 birthday">
                                <input id="birthday_dd" class="birthday" type="text" maxlength="2" class="form-control @error('birthday_dd') is-invalid @enderror" name="birthday_dd" value="{{ old('birthday_dd') }}" required autocomplete="birthday" placeholder="ДД" autofocus>
                                <input id="birthday_mm" class="birthday" type="text" maxlength="2" class="form-control @error('birthday_mm') is-invalid @enderror" name="birthday_mm" value="{{ old('birthday_mm') }}" required autocomplete="birthday" placeholder="ММ" autofocus>
                                <input id="birthday_yy" class="birthday year" type="text" maxlength="4" class="form-control @error('birthday_yy') is-invalid @enderror" name="birthday_yy" value="{{ old('birthday_yy') }}" required autocomplete="birthday" placeholder="ГГГГ" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
