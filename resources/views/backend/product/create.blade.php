@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Thêm sản phẩm</div>
    
        <div class="card-body">
            @if ($productCategories->count() > 0 && $tags->count() > 0)
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Chọn danh mục sản phẩm') }}</label>

                        <div class="col-md-9">
                            <select id="product_category_id" type="text" class="form-control{{ $errors->has('product_category_id') ? ' is-invalid' : '' }}" name="product_category_id" required autofocus>
                                @foreach ($productCategories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('product_category_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('product_category_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Tên sản phẩm') }}</label>

                        <div class="col-md-9">
                            <textarea id="name" rows="3" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            
                            </textarea>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Mô tả') }}</label>

                        <div class="col-md-9">
                            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required autofocus>
                            
                            </textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="import_price" class="col-md-2 col-form-label text-md-right">{{ __('Giá nhập') }}</label>

                        <div class="col-md-9">
                            <input min="1" id="import_price" type="number" class="form-control{{ $errors->has('import_price') ? ' is-invalid' : '' }}" name="import_price" value="{{ old('import_price') }}" required autofocus >
                            @if ($errors->has('import_price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('import_price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Giá bán') }}</label>

                        <div class="col-md-9">
                            <input min="1" id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}" required autofocus>
                            
                            @if ($errors->has('price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="discount" class="col-md-2 col-form-label text-md-right">{{ __('Discount') }}</label>

                        <div class="col-md-9">
                            <input  min="1" id="discount" type="number" class="form-control{{ $errors->has('discount') ? ' is-invalid' : '' }}" name="discount" value="{{ old('discount') }}" required autofocus>
                            
                            @if ($errors->has('discount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('discount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="qty" class="col-md-2 col-form-label text-md-right">{{ __('Số lượng') }}</label>

                        <div class="col-md-9">
                            <input  min="1" id="qty" type="number" class="form-control{{ $errors->has('qty') ? ' is-invalid' : '' }}" name="qty" value="{{ old('qty') }}" required autofocus>
                            
                            @if ($errors->has('qty'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('qty') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tag" class="col-md-2 col-form-label text-md-right">{{ __('Tags') }}</label>

                        <div class="col-md-9">
                            @foreach ($tags as $tag)
                                <label for="tags[]"><input type="checkbox" id="tags[]" name="tags[]" value="{{ $tag->id }}"/>&nbsp;{{ $tag->name }}</label>&nbsp;&nbsp;
                            @endforeach

                            @if ($errors->has('tags[]'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tags[]') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Hình ảnh') }}</label>

                        <div class="col-md-9">
                            <input id="image" multiple type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image[]" value="{{ old('image') }}" required autofocus/>
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
                Vui lòng thêm <a href="{{ route('productcategories.create') }}">danh mục sản phẩm</a> và <a href="{{ route('tags.create') }}">tag</a>!
            @endif
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

    <script>
        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var fieldHTML = '<div class="row">';   
            fieldHTML+= '<div class="col-md-3">'
            fieldHTML+=   '<input required class="form-control" type="number" name="qtys[]" min="1" placeholder="Số lượng"/>';
            fieldHTML+= '</div>';

            fieldHTML+= '<div class="col-md-3">'
            fieldHTML+=   '<a href="javascript:void(0);" class="remove_button btn btn-outline-danger">Xóa</a>';
            fieldHTML+= '</div>';
            fieldHTML+= '</div>'; //New input field html 
            var x = 1; //Initial field counter is 1
            
            //Once add button is clicked
            $('.add_button').click(function(){
                //Check maximum number of input fields
                if(x < maxField){ 
                    x++; //Increment field counter
                    $('.field_wrapper').append(fieldHTML); //Add field html
                }
                
            });
            
            //Once remove button is clicked
            $('.field_wrapper').on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>
@endsection

@section('style')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endsection
