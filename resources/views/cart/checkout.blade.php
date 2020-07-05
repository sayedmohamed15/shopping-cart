@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p class="mb-4">
                    Total Amount is <strong> ${{ $amount}}</strong>
                </p>
                <form action="{{route('cart.charge')}}" method="post">
                    @csrf
                    <input type="hidden"  name='total' value="{{$amount}}">
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control @error('name') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Telephone') }}</label>
                        <div class="col-md-6">
                            <input id="tel" type="tel" class="form-control @error('name') is-invalid @enderror" name="tel" value="{{ old('tel') }}" placeholder="123-4567-6778" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" required autocomplete="name" autofocus>
                            @error('tel')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('CheckOut') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
