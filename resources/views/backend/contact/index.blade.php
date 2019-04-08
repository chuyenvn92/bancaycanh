@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Contact</div>
        
        <div class="card-body">
            <div class="form-group row">
                <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('Address') }}</label>

                <div class="col-md-9">
                    <textarea readonly id="address" rows="4" class="form-control{{ $errors->has('adress') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>{{ $contact->address }}</textarea>
                    @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="number_phone" class="col-md-2 col-form-label text-md-right">{{ __('Number phone') }}</label>

                <div class="col-md-9">
                    <input readonly id="number_phone" value="{{$contact->number_phone}}" class="form-control{{ $errors->has('number_phone') ? ' is-invalid' : '' }}" name="number_phone" value="{{ old('number_phone') }}" required autofocus/>
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
                    <input readonly id="email" value="{{$contact->email}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus/>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-9 offset-md-2">
                    <a class="btn btn-primary" href="{{route('contacts.edit',['id' => $contact->id ])}}">
                        {{ __('Edit') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


