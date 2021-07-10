@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Thêm bài viết</div>
    
        <div class="card-body">
            @if ($tags->count() > 0 && $postCategories->count() > 0 )
                <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Chọn danh mục bài viết') }}</label>

                        <div class="col-md-9">
                            <select id="post_category_id" type="text" class="form-control{{ $errors->has('post_category_id') ? ' is-invalid' : '' }}" name="post_category_id" required autofocus>
                                @foreach ($postCategories as $category)
                                    <option value="{{$category->id}}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('post_category_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('post_category_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Tiêu đề') }}</label>

                        <div class="col-md-9">
                            <textarea id="title" rows="3" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>
                            
                            </textarea>
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
                            <textarea id="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" required autofocus>{{ old('content') }}</textarea>
                            @if ($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="tag" class="col-md-2 col-form-label text-md-right">{{ __('Tags') }}</label>

                        <div class="col-md-9">
                            @foreach ($tags as $tag)
                                <label for="tags[]"><input type="checkbox" id="tags[]" name="tags[]" value="{{$tag->id}}"/>&nbsp;{{$tag->name}}</label>&nbsp;&nbsp;
                            @endforeach

                            @if ($errors->has('tags'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tags') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Hình ảnh') }}</label>

                        <div class="col-md-9">
                            <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" value="{{ old('image') }}" required autofocus/>
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-9 offset-md-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Thêm mới') }}
                            </button>
                        </div>
                    </div>
                </form>
            @else
                Please create new <a href="{{ route('postcategories.create') }}">product category</a> and <a href="{{ route('tags.create') }}">tag</a>
            @endif
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
