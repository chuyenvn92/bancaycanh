@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Sửa liên hệ</div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('contacts.update', ['id' => $contact->id ]) }}">
                @csrf
                @method('PUT')

                    <div class="form-group row">
                        <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('Địa chỉ') }}</label>
        
                        <div class="col-md-9">
                            <textarea id="address" rows="4" class="form-control{{ $errors->has('adress') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>{{ $contact->address }}</textarea>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <label for="number_phone" class="col-md-2 col-form-label text-md-right">{{ __('Số điện thoại') }}</label>
        
                        <div class="col-md-9">
                            <input id="number_phone" value="{{$contact->number_phone}}" class="form-control{{ $errors->has('number_phone') ? ' is-invalid' : '' }}" name="number_phone" value="{{ old('number_phone') }}" required autofocus/>
                            @if ($errors->has('number_phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('number_phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-mail') }}</label>
        
                        <div class="col-md-9">
                            <input id="email" value="{{$contact->email}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus/>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-2">
                        <button class="btn btn-primary" type="submit">
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
            $('#content').summernote({
            height: 300
            });
        });
    </script>
@endsection

@section('style')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endsection
