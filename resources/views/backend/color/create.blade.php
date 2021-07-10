@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Thêm color</div>
    
        <div class="card-body">
            <form method="POST" action="{{ route('colors.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tên màu') }}</label>

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
                    <label for="color_code" class="col-md-4 col-form-label text-md-right">{{ __('Mã màu') }}</label>

                    <div class="col-md-6">
                        <input id="color_code" type="text" class="form-control{{ $errors->has('color_code') ? ' is-invalid' : '' }}" name="color_code" value="{{ old('color_code') }}" required autofocus>

                        @if ($errors->has('color_code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('color_code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Thêm mới') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
