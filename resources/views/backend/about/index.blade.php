@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Giới thiệu</div>
        
        <div class="card-body">
            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Tiêu đề') }}</label>

                <div class="col-md-9">
                    <textarea readonly id="title" rows="3" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>{{ $about->title }}</textarea>
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="content" class="col-md-2 col-form-label text-md-right">{{ __('Nội dung') }}</label>

                <div class="col-md-9">
                    <textarea readonly id="content" rows="13" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" value="{{ old('content') }}" required autofocus>{!! $about->content !!}</textarea>
                    @if ($errors->has('content'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group row mb-0">
                <div class="col-md-9 offset-md-2">
                    <a class="btn btn-primary" href="{{route('abouts.edit',['id' => $about->id ])}}">
                        {{ __('Sửa') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


