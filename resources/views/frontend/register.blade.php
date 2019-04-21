@extends('layouts.master')


@section('title')
    Register
@endsection

@section('content')
<form class="bg0 p-t-75 p-b-85" action="{{ route('register.store') }}" method="POST">
    @csrf
    <div class="container">
        <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Dob') }}</label>

                <div class="col-md-6">
                    <input id="dob" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}" required autofocus>

                    @if ($errors->has('dob'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('dob') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('Sex') }}</label>

                <div class="col-md-6">
                    <select id="sex" type="radio" class="form-control{{ $errors->has('sex') ? ' is-invalid' : '' }}" name="sex" value="{{ old('sex') }}" required autofocus>
                        <option value="1">Nam</option>
                        <option value="0">Nữ</option>
                    </select>
                    
                    @if ($errors->has('sex'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sex') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="number_phone" class="col-md-4 col-form-label text-md-right">{{ __('Number phone') }}</label>

                <div class="col-md-6">
                    <input id="number_phone" type="number" class="form-control{{ $errors->has('number_phone') ? ' is-invalid' : '' }}" name="number_phone" value="{{ old('number_phone') }}" required autofocus>

                    @if ($errors->has('number_phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('number_phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                <div class="col-md-6">
                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>

                    @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>

    
    </div>
</form>
@endsection
    
@section('style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection