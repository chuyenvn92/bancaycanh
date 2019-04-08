@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Edit slide</div>
    
        <div class="card-body">
            <form method="POST" action="{{ route('slides.update', ['id' => $slide->id ]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                    <div class="col-md-9">
                        <textarea id="title" rows="3" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>{{ $slide->title }}</textarea>
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
                        <textarea id="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" value="{{ old('content') }}" required autofocus>{{ $slide->content }} </textarea>
                        @if ($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>

                    <div class="col-md-9">
                        <input id="image" type="file" class="form-control" name="image"/>
                        @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-9 offset-md-2">
                        <img class="form-control" src="{{ asset($slide->image) }}" alt="" style="height: 250px;">
                    </div>
                </div>   
                <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Edit') }}
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
            height: 200
            });
        });
    </script>
@endsection

@section('style')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endsection
