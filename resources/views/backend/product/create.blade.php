@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Add product</div>
    
        <div class="card-body">
            @if ($productCategories->count() > 0 && $tags->count() > 0)
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Product categories') }}</label>

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
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Product name') }}</label>

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
                        <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>

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
                        <label for="import_price" class="col-md-2 col-form-label text-md-right">{{ __('Import price') }}</label>

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
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Price') }}</label>

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
                        <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>

                        <div class="col-md-9">
                            <input id="image" multiple type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image[]" value="{{ old('image') }}" required autofocus/>
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="attribute" class="col-md-2 col-form-label text-md-right">{{ __('Add attributes') }}</label>

                        <div class="col-md-9">
                            <div class="field_wrapper">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select class="form-control mb-3" name="sizes[]">
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
            
                                    <div class="col-md-3">
                                        <select class="form-control" name="colors[]">
                                            @foreach ($colors as $color)
                                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <input required class="form-control" type="number" name="qtys[]" min="0" placeholder="Qty"/>
                                    </div>
        
                                    <div class="col-md-3">
                                        <a href="javascript:void(0);" class="add_button btn btn-outline-primary" title="Add field">Add</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-9 offset-md-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add new') }}
                            </button>
                        </div>
                    </div>
                </form>
            @else 
                Please create new <a href="{{ route('productcategories.create') }}">product category</a> and <a href="{{ route('tags.create') }}">tag</a>!
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
            fieldHTML+= '<div class="col-md-3 mb-3">';
            fieldHTML+= '<select class="form-control" name="sizes[]">';
            fieldHTML+=      '@foreach ($sizes as $size)';
            fieldHTML+=           '<option value="{{ $size->id }}">{{ $size->name }}</option>';
            fieldHTML+=      '@endforeach';
            fieldHTML+= '</select>';
            fieldHTML+= '</div>';

            fieldHTML+= '<div class="col-md-3">';
            fieldHTML+= '<select class="form-control" name="colors[]">';
            fieldHTML+=      '@foreach ($colors as $color)';
            fieldHTML+=           '<option value="{{ $color->id }}">{{ $color->name }}</option>';
            fieldHTML+=      '@endforeach';
            fieldHTML+= '</select>';
            fieldHTML+= '</div>';
    
            fieldHTML+= '<div class="col-md-3">'
            fieldHTML+=   '<input required class="form-control" type="number" name="qtys[]" min="0" placeholder="Qty"/>';
            fieldHTML+= '</div>';

            fieldHTML+= '<div class="col-md-3">'
            fieldHTML+=   '<a href="javascript:void(0);" class="remove_button btn btn-outline-danger">Remove</a>';
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
