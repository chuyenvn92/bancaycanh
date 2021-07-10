@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Sửa người dùng</div>
    
        <div class="card-body">
            <form method="POST" action="{{ route('users.update', ['id' => $user->id ]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Họ tên') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Ngày sinh') }}</label>

                    <div class="col-md-6">
                        <input id="dob" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ $user->dob }}" required autofocus>

                        @if ($errors->has('dob'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dob') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('Giới tính') }}</label>

                    <div class="col-md-6">
                        <select id="sex" type="radio" class="form-control{{ $errors->has('sex') ? ' is-invalid' : '' }}" name="sex" value="{{ old('sex') }}" required autofocus>
                            <option value="1" @if ($user->sex == 1)
                                {{ 'selected' }}
                            @endif>Nam</option>
                            <option value="0" @if ($user->sex == 0)
                                {{ 'selected' }}
                            @endif>Nữ</option>
                        </select>
                        
                        @if ($errors->has('sex'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sex') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="number_phone" class="col-md-4 col-form-label text-md-right">{{ __('Số điện thoại') }}</label>

                    <div class="col-md-6">
                        <input id="number_phone" type="text" class="form-control{{ $errors->has('number_phone') ? ' is-invalid' : '' }}" name="number_phone" value="{{ $user->number_phone }}" required autofocus>

                        @if ($errors->has('number_phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('number_phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Địa chỉ') }}</label>

                    <div class="col-md-6">
                        <textarea id="address" rows="4" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" required autofocus>{{ $user->address }}</textarea>

                        @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_admin" class="col-md-4 col-form-label text-md-right">{{ __('Quyền') }}</label>

                    <div class="col-md-6">
                        <select id="is_admin" class="form-control{{ $errors->has('is_admin') ? ' is-invalid' : '' }}" name="is_admin" value="{{ old('is_admin') }}" required>
                            <option @if ($user->is_admin == 0)
                                {{ 'selected' }}
                            @endif value="0">Khách hàng</option>
                            <option @if ($user->is_admin == 2)
                                {{ 'selected' }}
                            @endif value="1">Nhân viên</option>
                            <option @if ($user->is_admin == 1)
                                {{ 'selected' }}
                            @endif value="1">Admin</option>
                        </select>
                        @if ($errors->has('is_admin'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('is_admin') }}</strong>
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
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Nhập lại Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Hình ảnh') }}</label>

                    <div class="col-md-6">
                        <input id="image" type="file" class="form-control" name="image">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Sửa') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js" defer></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote({
            height: 200
            });
        });
    </script>
@endsection

@section('style')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endsection
