@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Edit about</div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('abouts.update', ['id' => $about->id ]) }}">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                    <div class="col-md-9">
                        <textarea id="title" rows="3" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>{{ $about->title }}</textarea>
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content" class="col-md-2 col-form-label text-md-right">{{ __('Content') }}</label>

                    <div class="col-md-9">
                        <textarea id="content" rows="15" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" value="{{ old('content') }}" required autofocus>{!! $about->content !!}</textarea>
                        @if ($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-2">
                        <button class="btn btn-primary" type="submit">
                            {{ __('Ok') }}
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
            $('#content').summernote({
                height: 300
            });
        });
    </script>
@endsection

@section('style')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endsection
